<?php
   session_start();
   
   if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
     header("Location: index.php");
     exit;
   }
   
   $tok = $_SESSION['token'];
   $curl = curl_init();
   
   if(isset($_POST['name'])){
   $name = addslashes($_POST['name']);
    
         curl_setopt_array($curl, array(
         CURLOPT_URL => 'http://localhost/to-do/api/task/new/',
         CURLOPT_CUSTOMREQUEST => 'POST',
         CURLOPT_POSTFIELDS => json_encode(['name'=>$name]),
         CURLOPT_HTTPHEADER => array("Content-Type: application/json","Authorization:$tok"),));
         curl_exec($curl);
           
   }
   include 'header.php';
   ?>
<div class="all">
   <h2>Lista de tarefas abaixo:</h2>
   <br><br>
   <?php 
      $postData = ['token'=>$tok];
      curl_setopt_array($curl, array(
      CURLOPT_URL => 'http://localhost/to-do/api/task/search/',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => json_encode($postData),
      CURLOPT_HTTPHEADER => array("Content-Type: application/json","Authorization:$tok"),));
      $js = json_decode(curl_exec($curl), true);
      
      if(@$js['message'] == 'Tasks not found'){
        echo 'Sem tarefas';
      }else{
      foreach($js as $task):            
        $id = $task['id'];
        ?>
   <a href="up.php?id=<?php echo $task['id'];?>&&input=<?php echo $task['name']; ?>&&realized=<?php echo $task['realized']; ?>"><?php echo $task['name']; ?></a>
   <?php if($task['realized'] =='0'){ echo '<p style="color:red">Pendente';}else{echo '<p style="color:green">Tarefa realizada</p>';} ?></p>
   <br>
   <hr>
   <?php
      endforeach;  
      }
      ?>
</div>
<div class="w3-container" style="float: right;">
   <button onclick="document.getElementById('id01').style.display='block'" class="w3-button w3-black">+</button>
   <div id="id01" class="w3-modal">
      <div class="w3-modal-content" style="text-align: center;">
         <div class="w3-container" style="height: 130px;">
            <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright">&times;</span> <br>
            <form method="POST" > 
               <label style="">Nova tarefa</label><br>
               <input type="text" placeholder="Tarefas" name="name">
               <input type="submit" name="btn" class="btn-primary" style="margin-top: 10px;background: white; border: 0px; color: blue;" value="Salvar">
            </form>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript" src="assets/js/modal.js"></script>