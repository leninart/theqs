<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><?php echo $title.' '.$vars[0]['surname'].' '.$vars[0]['name']; ?></div>
            <div class="col-md-3">
                <img src="/public/img/avatar/<?php echo $vars[0]['avatar']; ?>" alt="">
            </div>

            <div class="col-md-3">Бонусы: <? echo $vars[0]['bonuse'] ?></div>
            <style>
    #priority {
  display: none;
}
</style>
      <form>
          <select id="sel" onchange="change()" name = "type">
              <option value = "A">A</option>
              <option value = "MX">MX</option>
          </select>
          <input type = "text" name = "host" placeholder = "Хост записи">
          <input type = "text" name = "content" placeholder = "Содержимое записи">
<!-- Вот этот input должен появляться в форме, только если выбрано значение "MX" в селекте -->
          <input type = "text" name = "priority" id = "priority" placeholder = "Приоритет записи">
          <input type = "submit" name = "createdns" value = "Создать запись">
      </form>
  <script>
    function change()
    {  
      var val = document.getElementById('sel').value  
      var parent = document.getElementById('priority'); 
      if (val=='MX') {
        parent.style.display = 'inline';
      } else {
        parent.style.display = 'none';
        }  
    }
</script>
        </div>
    </div>
</div>