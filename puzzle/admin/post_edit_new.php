<?php require_once "../system/common_admin.php";?>

<?php $page_title = "新規商品登録";?>
<?php require "header.php";?>
<p><a href="post_list.php">一覧へ戻る</a></p>

<div class="wrapper">

    <form action="post_edit_confirm.php" method="post" enctype="multipart/form-data">
      <div class="detail_box">
      <div class="detail_left">
        <label>商品画像<span class="attention">[必須]</span></label><br>
        <p>画像ファイルを選択してください。</p><br>
          <input type="hidden" name="max_file_size" value="1000000" />
          <input type="file" size="50" name="upfile" required>
        
      </div>
      <div class="detail_right">
      <div class="padding">
        品名<span class="attention">[必須]</span><br>
        <input type="text" name="product_name" size="30" required>
      </div>
      <div class="padding">
        カテゴリ<span class="attention">[必須]</span><br>
        <select name="product_category" required>
          <option></option>
          <option value="知恵の輪">知恵の輪</option>
          <option value="ルービックキューブ">ルービックキューブ</option>
          <option value="木製パズル">木製パズル</option>
          <option value="空間認識">空間認識</option>
        </select>
      </div>
      <div class="padding">
        難易度(Level)<span class="attention">[必須]</span><br>
        <select name="product_level" required>
        <option></option>
          <script>
          for(var i = 1; i <= 5; i++){
            document.write("<option>");
            document.write(i);
            document.write("</option>");
          }
          </script>
        </select>
      </div>
      
      <div class="padding">
        商品説明<br>
        <textarea name="product_comments" rows="5" cols="20"></textarea>
      </div>
      <div>
        <input type="submit" name="send" value="登録する">
      </div>
      </div>
      </div>
    </form>
</div>
<?php require "footer.php";?>