<html>
<head>
     <title>microCMSで取得したデータをテンプレートエンジンを使って表示するぞ</title>
   </head>

   <body>
     <div class="l-container">
       <h1 class="ttl-news">お知らせ</h1>


       <?php
       $id = $_GET['id'];

       // クエリパラメータを取得
       if (isset($id) == true) {
           GetContent($id);
       } else {
           echo 'Set query parameters';
       }

       function GetContent($id)
       {
           // cUrlでAPIを叩く
           $ch = curl_init();
           curl_setopt($ch, CURLOPT_URL, 'https://cayemanfan.microcms.io/api/v1/blogs/' . $id);
           curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
           curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

           $headers[] = 'X-MICROCMS-API-KEY: 5951b73985eb44e7b26cea3ec0fc0d837691';
           curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
           $response = curl_exec($ch);
           curl_close($ch);

           // 取得したら表示
           $result = json_decode($response, true);
           if (isset($result) == true) {
               ShowHtml(
                   $result['title'],
                   $result['content'],
                   $result['links'],
               );
           }else{
               echo "IDに該当する記事がありません";
           }
       }
       }

       // コンテンツ表示部
       function ShowHtml($title, $createAt, $updatedAt, $body)
       {
           echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
           echo '<h2>タイトル:' . $title . '</h2>';
           echo '<p>作成日:' . $links . '</p>';
           echo '<article style="background-color: aliceblue;">本文:<br>' . $content . '</article>';
       }





       <div id="content"></div>


     </div>

   </body>



 </html>
