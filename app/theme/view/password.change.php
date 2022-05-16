<?php require PATH . '/theme/view/common/header.php';?>
<div class="container d-flex flex-column">
    <div class="row align-items-center justify-content-center">
        <div class="col-md-6 col-lg-6 col-xl-6 py-3 py-md-5">
            <form method="post" class="py-5">
                <input type="hidden" name="_ACTION" value="change">
                <div class="form-group">
                    <label class="form-control-label">Yeni Şifreniz</label>
                    <input type="password" name="password" class="form-control form-control-lg" id="input-password" placeholder="Yeni Şifreniz" autofocus="true" required="true">
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-block btn-lg btn-theme">Şifremi Değiştir</button>
                </div>
            </form> 
        </div>
    </div>
</div>
<?php require PATH . '/theme/view/common/footer.php';?>