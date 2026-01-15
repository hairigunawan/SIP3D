<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prestasi;
use Illuminate\Support\Facades\Response;

class TPKController extends Controller
{
    /**
     * Tampilkan halaman utama TPK (SAW) dengan:
     * - tabel alternatif
     * - bobot kriteria
     * - normalisasi
     * - weighted matrix
     * - hasil akhir + ranking
     */
    public function index(Request $request)
    {
        // 1) Ambil data alternatif (prestasis). Optional: search param 'q'
        $q = $request->get('q');
        $query = Prestasi::query();
        if ($q) {
            $query->where(function($qr) use ($q) {
                $qr->where('nama', 'like', "%{$q}%")
                   ->orWhere('nama_prestasi', 'like', "%{$q}%")
                   ->orWhere('code', 'like', "%{$q}%");
            });
        }
        $prestasis = $query->get();

        // 2) Tentukan kriteria (kolom di tabel prestasis yang akan dipakai)
        // Sesuaikan urutan kriteria dengan view (C1..Cn)
        $criteria = [
            'skor_sinta',
            'skor_sinta_3yr',
            'jumlah_buku',
            'jumlah_hibah',
            'publikasi_scholar',
        ];

        // Labels yang akan tampil di header tabel
        $criteria_labels = [
            'Sinta Score',
            'Sinta 3Yr Score',
            'Number of Books',
            'Number of Grants',
            'Scholar Publication (1Yr)',
        ];

        // 3) Ambil bobot dari model Kriteria jika ada, otherwise equal weights
        // Bobot akan dikembalikan keyed by 'C1','C2',... dan juga mapped per kolom
        $weights = $this->getWeightsFallback(count($criteria)); // returns ['C1'=>0.2,...]
        $weights_per_col = [];
        foreach ($criteria as $idx => $col) {
            $key = 'C' . ($idx + 1);
            $weights_per_col[$col] = $weights[$key] ?? 0;
        }

        // 4) Hitung max tiap kolom (untuk normalisasi benefit)
        $max = [];
        foreach ($criteria as $col) {
            $max[$col] = $prestasis->max($col) ?: 0;
        }

        // 5) Normalisasi r_ij = value / max_j
        $normalized = [];
        foreach ($prestasis as $p) {
            $row = [
                'label' => $p->code ?? $p->nama ?? ($p->nama_prestasi ?? ('ID'.$p->id)),
            ];
            foreach ($criteria as $col) {
                $val = (float) ($p->{$col} ?? 0);
                $r = $max[$col] > 0 ? ($val / $max[$col]) : 0;
                $row[$col] = $r;
            }
            $normalized[] = $row;
        }

        // 6) Weighted matrix & score (V)
        $weighted = [];
        foreach ($normalized as $row) {
            $wt = ['label' => $row['label'], 'score' => 0];
            $sum = 0;
            foreach ($criteria as $col) {
                $r = $row[$col] ?? 0;
                $w = $weights_per_col[$col] ?? 0;
                $val = $r * $w;
                $wt[$col] = $val;
                $sum += $val;
            }
            $wt['score'] = $sum;
            $weighted[] = $wt;
        }

        // 7) Ranking (sort descending by score)
        usort($weighted, function ($a, $b) {
            return ($b['score'] <=> $a['score']);
        });

        $results = [];
        $rank = 1;
        foreach ($weighted as $w) {
            $results[] = [
                'rank' => $rank++,
                'label' => $w['label'],
                'score' => $w['score'],
            ];
        }

        // 8) Total bobot (untuk tampilan)
        $total_bobot = array_sum(array_values($weights));

        // 9) Data table raw (untuk Data TPK di view)
        $prestasisTable = $prestasis;

        return view('TPK.index', compact(
            'prestasisTable',
            'weights',
            'criteria_labels',
            'criteria',
            'normalized',
            'weighted',
            'results',
            'total_bobot'
        ));
    }

    /**
     * Export hasil ranking (V) ke CSV.
     * Endpoint: GET /admin/tpk/export
     */
    public function exportCsv(Request $request)
    {
        // Reuse index logic to compute weighted results
        // (we can call the logic above or duplicate minimal necessary parts)
        $q = $request->get('q');
        $query = Prestasi::query();
        if ($q) {
            $query->where(function($qr) use ($q) {
                $qr->where('nama', 'like', "%{$q}%")
                   ->orWhere('nama_prestasi', 'like', "%{$q}%")
                   ->orWhere('code', 'like', "%{$q}%");
            });
        }
        $prestasis = $query->get();

        $criteria = [
            'skor_sinta',
            'skor_sinta_3yr',
            'jumlah_buku',
            'jumlah_hibah',
            'publikasi_scholar',
        ];

        // weights
        $weights = $this->getWeightsFallback(count($criteria));
        $weights_per_col = [];
        foreach ($criteria as $idx => $col) {
            $key = 'C' . ($idx + 1);
            $weights_per_col[$col] = $weights[$key] ?? 0;
        }

        // max
        $max = [];
        foreach ($criteria as $col) {
            $max[$col] = $prestasis->max($col) ?: 0;
        }

        // normalized + weighted + score
        $rows = [];
        foreach ($prestasis as $p) {
            $label = $p->code ?? $p->nama ?? ($p->nama_prestasi ?? ('ID'.$p->id));
            $score = 0;
            $row = [
                'code' => $p->code ?? null,
                'name' => $p->nama ?? $p->nama_prestasi ?? null,
            ];
            foreach ($criteria as $col) {
                $val = (float) ($p->{$col} ?? 0);
                $r = $max[$col] > 0 ? ($val / $max[$col]) : 0;
                $weightedVal = $r * ($weights_per_col[$col] ?? 0);
                $row[$col] = $val;
                $row[$col . '_normalized'] = $r;
                $row[$col . '_weighted'] = $weightedVal;
                $score += $weightedVal;
            }
            $row['score'] = $score;
            $rows[] = $row;
        }

        // rank rows by score desc
        usort($rows, function ($a, $b) {
            return ($b['score'] <=> $a['score']);
        });

        // prepare CSV
        $filename = 'tpk_results_' . date('Ymd_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $columns = [
            'Rank', 'Code', 'Name'
        ];
        // add criteria columns (raw), normalized, weighted
        foreach ($criteria as $col) {
            $columns[] = ucfirst($col);
        }
        foreach ($criteria as $col) {
            $columns[] = $col . '_normalized';
        }
        foreach ($criteria as $col) {
            $columns[] = $col . '_weighted';
        }
        $columns[] = 'Score';

        $callback = function () use ($rows, $columns) {
            $out = fopen('php://output', 'w');
            // bom for excel compatibility (optional)
            // fprintf($out, chr(0xEF).chr(0xBB).chr(0xBF));
            fputcsv($out, $columns);

            $rank = 1;
            foreach ($rows as $r) {
                $line = [
                    $rank++,
                    $r['code'] ?? '',
                    $r['name'] ?? '',
                ];
                // raw values
                foreach ([
                    'skor_sinta',
                    'skor_sinta_3yr',
                    'jumlah_buku',
                    'jumlah_hibah',
                    'publikasi_scholar'
                ] as $col) {
                    $line[] = $r[$col] ?? 0;
                }
                // normalized
                foreach ([
                    'skor_sinta',
                    'skor_sinta_3yr',
                    'jumlah_buku',
                    'jumlah_hibah',
                    'publikasi_scholar'
                ] as $col) {
                    $line[] = round($r[$col . '_normalized'] ?? 0, 6);
                }
                // weighted
                foreach ([
                    'skor_sinta',
                    'skor_sinta_3yr',
                    'jumlah_buku',
                    'jumlah_hibah',
                    'publikasi_scholar'
                ] as $col) {
                    $line[] = round($r[$col . '_weighted'] ?? 0, 6);
                }

                $line[] = round($r['score'] ?? 0, 6);

                fputcsv($out, $line);
            }

            fclose($out);
        };

        return Response::stream($callback, 200, $headers);
    }

    /**
     * Helper: get weights from model Kriteria if exists,
     * otherwise return equal weights keyed by C1..Cn.
     *
     * @param int $nCriteria
     * @return array keyed by 'C1'..'Cn'
     */
    protected function getWeightsFallback(int $nCriteria = 1): array
    {
        // try to use App\Models\Kriteria if exists
        if (class_exists(\App\Models\Kriteria::class)) {
            try {
                $krs = \App\Models\Kriteria::orderBy('id')->get();
                if ($krs->count() >= $nCriteria) {
                    $weights = [];
                    $i = 1;
                    foreach ($krs as $kr) {
                        // expect kolom 'bobot' or 'weight' on model
                        $w = $kr->bobot ?? $kr->weight ?? 0;
                        $weights['C' . $i] = (float) $w;
                        $i++;
                        if ($i > $nCriteria) break;
                    }
                    // if fewer entries than nCriteria, fill remaining equally
                    while ($i <= $nCriteria) {
                        $weights['C' . $i] = 0;
                        $i++;
                    }
                    return $weights;
                }
            } catch (\Throwable $e) {
                // ignore and fallback
            }
        }

        // fallback: equal weights
        $w = $nCriteria ? (1 / $nCriteria) : 0;
        $weights = [];
        for ($i = 1; $i <= $nCriteria; $i++) {
            // keep numeric precision reasonable
            $weights['C' . $i] = round($w, 4);
        }
        return $weights;
    }
}
