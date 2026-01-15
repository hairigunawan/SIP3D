<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Konfirmasi Role - SIP2D</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card shadow-sm">
          <div class="card-body text-center">
            <h4 class="mb-3">Account Role Confirmation</h4>

            <p>
              The Google account you are using is registered as:
              <br><strong class="text-primary">{{ strtoupper($currentRole) }}</strong>
            </p>

            <p>
              But you previously chose to log in as:
              <br><strong class="text-danger">{{ strtoupper($intent) }}</strong>
            </p>

            <p class="text-muted small">
              For system security reasons, roles cannot be automatically changed.
              Please select an action below.
            </p>

            <div class="d-flex justify-content-center gap-3 mt-4">
              {{-- FORM: Continue as current role (safe) --}}
              <form method="POST" action="{{ route('login.google.confirm_role.continue') }}">
                @csrf
                <input type="hidden" name="choose" value="current">
                <button type="submit" class="btn btn-primary">Continue as {{ ucfirst($currentRole) }}</button>
              </form>

              {{-- FORM: Continue as intent (temporary active_role in session) --}}
              <form method="POST" action="{{ route('login.google.confirm_role.continue') }}">
                @csrf
                <input type="hidden" name="choose" value="intent">
                <button type="submit" class="btn btn-outline-secondary">Continue as {{ ucfirst($intent) }}</button>
              </form>

              {{-- Cancel --}}
              <form method="POST" action="{{ route('login.google.confirm_role.cancel') }}">
                @csrf
                <button type="submit" class="btn btn-link text-muted">Cancel / Return</button>
              </form>
            </div>

            <hr>

            <small class="text-muted d-block mt-3">
              Want to change your account role? Please contact the Administrator.
            </small>

          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
