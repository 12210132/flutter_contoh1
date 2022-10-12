<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Login Perpustakaan</title>
        <link herf="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
            rel="stylesheet" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
            crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
            crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/gh/agoenxz2186/submitAjax@develop/submit_ajax.js"
            ></script>

        <meta nama="viewport" content="width=device-width,initial-scale=1">

    </head>
    <body>
        <div class="constrainer">
            <form id="form-login" method="post" action="<?=base_url('/login')?>">
                <h3>Login Perpustakaan</h3>
            
                <div class="row">
                    <div class="form-froup col-md-4">
                        <div class="mb-3">
                            <label for="email" class="form-label">Alamat Email</label>
                            <input type="email" name="email" class="form-control" id="email"
                                    placeholder="name@example.com">
                                
                        </div>
                        <div class="mb-3">
                            <label for="sandi" class="form--label">Sandi Email</label>
                            <input type="password" name="sandi" class=>"form-control" id="sandi"
                        </div>

                        <button type="submit" class="btn-primary mb-#">Login</button>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>