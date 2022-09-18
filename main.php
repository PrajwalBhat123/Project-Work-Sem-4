// kick animation using William Malone's code 
// http://www.williammalone.com/articles/create-html5-canvas-javascript-sprite-animation/

// Copyright 2013 William Malone (www.williammalone.com)
//
// Licensed under the Apache License, Version 2.0 (the "License");
// you may not use this file except in compliance with the License.
// You may obtain a copy of the License at
//
//   http://www.apache.org/licenses/LICENSE-2.0
//
// Unless required by applicable law or agreed to in writing, software
// distributed under the License is distributed on an "AS IS" BASIS,
// WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
// See the License for the specific language governing permissions and
// limitations under the License.
 
<html>
  <head>
  </head>
  <body>
    <?php
      require 'index.php';
      require_once 'authentication.php';
      
      if(!$_SESSION['username']){
        header('location:login.php');
      }
      
      $username = $_SESSION['username'];

    ?>

      </body>
</html>

