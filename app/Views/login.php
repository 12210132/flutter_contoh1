<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Login Sistem Perpus</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
              rel="stylesheet" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
             integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" 
             integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" 
             integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        
            <meta name="viewport" content="width=device-width, initial-scale=1">

    </head>
    <body>
        <div class="container">
            <form id="form-login" method="post" action="<?=base_url('/login')?>">
                <h3>Login Sistem Perpus</h3>

                <div class="row">
                    <div class="form-froup col-md-4">
                        <div class="mb-3">
                            <label for="email" class="from-label">Alamat Email</label>
                            <input type="email" name="email" class="form-control" id="email"
                                   placeholder="name@example.com">
                        </div>
                        <div class="mb-3">
                        <label for="sandi" class="form-label">Sandi</label>
                             <input type="password" name="sandi" class="form-control" id="sandi">
                        </div>

                        <button type="submit" class="btn btn-primary mb-3">Login</button>
                    </div>
                </div>

            </form>   
        </div>
    </body>
</html>   