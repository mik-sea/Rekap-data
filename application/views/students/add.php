<div class="container-fluid">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Tambah Data Mahasiswa</h1>
                </div>
                <form class="user" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="fullname" name="fullname" placeholder="Full Name">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control form-control-user" id="exampleInputEmail" name="email" placeholder="Email Address">
                    </div>
                    <div class="form-group">
                            <input type="password" class="form-control form-control-user" id="exampleInputPassword" name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                    <input type="file" name="gambar" id="gambar" accept="image/*">
                    </div>
                    <a href="login.html" class="btn btn-primary btn-user btn-block">
                        Tambah
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>