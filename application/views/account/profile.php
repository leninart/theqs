<div class="container">
    <h1 class="mt-4 mb-3"><?php echo $title;?></h1>
    <div class="row">
        <div class="col-md-3">
                    <div class="controls">
                        <img src="../public/img/avatar/<? echo $_SESSION['account']['avatar']; ?>" alt="">
                        <p class="help-block">Аватар</p>
                    </div>
                </div>
                <form action="download" method="post" enctype="multipart/form-data" id="my_form">
                    <input type="file" name="upload" id="my_file">
                    <progress id="progressbar" value="0" max="100"></progress>
                     <button>Загрузить</button>
                </form>
        <div class="col-lg-8 mb-4">
             <form action="/account/profile" method="post">
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Телефон:</label>
                        <input type="text" class="form-control" value="<?php echo $_SESSION['account']['phone']; ?>" disabled>
                        <p class="help-block"></p>
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Номер карты</label>
                        <input type="text" class="form-control" name = "card" value="<?php echo $_SESSION['account']['card']; ?>" disabled>
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email" value="<?php echo $_SESSION['account']['email']; ?>">
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Новый пароль для входа</label>
                        <input type="password" class="form-control" name="password">
                     </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Баллы</label>
                        <input type="text" class="form-control" name = "bonuse" value="<?php echo $_SESSION['account']['bonuse']; ?>" disabled>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Сохранить/Обновить</button>
            </form>
        </div>
    </div>
</div>