<?php
 $dsn = 'mysql:dbname=php_db_app;host=localhost;charset=utf8mb4';
 $user = 'root';
// MAMPを利用しているMacユーザーの方は、''ではなく'root'を代入してください
 $password = '';
 
 // セレクトボックスの選択肢として設定するため、仕入先コードの配列を取得する
 try {
     $pdo = new PDO($dsn, $user, $password);
 
     // vendorsテーブルからvendor_codeカラムのデータを取得するためのSQL文を変数$sql_selectに代入する
     $sql_select = 'SELECT vendor_code FROM vendors';
 
     // SQL文を実行する
     $stmt_select = $pdo->query($sql_select);
 
     // SQL文の実行結果を配列で取得する
     // 補足：PDO::FETCH_COLUMNは1つのカラムの値を1次元配列（多次元ではない普通の配列）で取得する設定である
     $vendor_codes = $stmt_select->fetchAll(PDO::FETCH_COLUMN);
 } catch (PDOException $e) {
     exit($e->getMessage());
 }
 ?>
 
 <!DOCTYPE html>
 <html lang="ja">
 
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>商品登録</title>
     <link rel="stylesheet" href="css/style.css">
 
     <!-- Google Fontsの読み込み -->
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">
 </head>
 
 <body>
     <header>
         <nav>
             <a href="index.php">商品管理アプリ</a>
         </nav>
     </header>
     <main>
         <article class="registration">
             <h1>商品登録</h1>
             <div class="back">
                 <a href="read.php" class="btn">&lt; 戻る</a>
             </div>
             <form action="create.php" method="post" class="registration-form">
                 <div>
                     <label for="product_code">商品コード</label>
                     <input type="number" name="product_code" min="0" max="100000000" required>
 
                     <label for="product_name">商品名</label>
                     <input type="text" name="product_name" maxlength="50" required>
 
                     <label for="price">単価</label>
                     <input type="number" name="price" min="0" max="100000000" required>
 
                     <label for="stock_quantity">在庫数</label>
                     <input type="number" name="stock_quantity" min="0" max="100000000" required>
 
                     <label for="vendor_code">仕入先コード</label>
                     <select name="vendor_code" required>
                         <option disabled selected value>選択してください</option>
                         <?php
                         // 配列の中身を順番に取り出し、セレクトボックスの選択肢として出力する
                         foreach ($vendor_codes as $vendor_code) {
                             echo "<option value='{$vendor_code}'>{$vendor_code}</option>";
                         }
                         ?>
                     </select>
                 </div>
                 <button type="submit" class="submit-btn" name="submit" value="create">登録</button>
             </form>
         </article>
     </main>
     <footer>
         <p class="copyright">&copy; 商品管理アプリ All rights reserved.</p>
     </footer>
 </body>
 
 </html>
