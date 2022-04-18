<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <section>
        <div class="">
            <form action="" method="post" enctype="multipart/form-data">
                    <div class="card col-md-6" style="margin: 0 auto;">
                        <div class="card-header">
                            <div class="card-title" style="text-align:center;">Update Profile</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="profile_image">Profile Image</label>
                                        <input class="form-control" id="profile_image" name="image" placeholder="profile Image" type="file">
                                    </div>
                                    <div class="form-group">
                                        <label for="fname">Full Name</label>
                                        <input class="form-control" id="fname" name="fullname" placeholder="Full Name" required type="text" value="ttttttttttttttttt">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email Address</label>
                                        <input class="form-control" id="email" name="email" placeholder="Email" required type="text" value="tt@gmail.com">
                                        <small id="emailHelp2" class="form-text text-muted">We'll never share your email
                                            with anyone else.</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input class="form-control" id="phone" name="phone" placeholder="Phone" required type="text" value="+18502033803">
                                        <small id="emailHelp2" class="form-text text-muted">We'll never share your phone number
                                                with anyone else.</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-action">
                            <button class="btn btn-secondary" type="submit">Submit</button>
                            <a href="/profile" class="btn btn-danger">Cancel</a>
                        </div>
                    </div>
                </form>
        </div>
    </section>
</body>
</html>