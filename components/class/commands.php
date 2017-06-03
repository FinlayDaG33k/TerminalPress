<?php
  class Commands{
    function help(){
      $output = "<pre>Commands:<br />
      list &lt;directory&gt;    Lists the content of the specified directory (default: current directory)<br />
      read &lt;post ID&gt;      Open a post by it's ID<br />
      help / ?            Shows this help dialog
      </pre>";
      return $output;
    }
    function ping(){
      return "pong";
    }

    function listItems($arguments){
      switch(strtolower($arguments[0])){
        case "~":
          echo "<pre>posts</pre>";
          break;
        case "posts":
          $posts = array();
          if ( have_posts() ){
            while ( have_posts() ) : the_post();
              $posts[get_the_ID()] = array("ID" => get_the_ID(),"Title" => get_the_title(), "Date" => get_the_time('F j, Y') . " @ " . get_the_time('g:i a'),"Excerpt" => get_the_excerpt());
            endwhile;
            if($posts > 0){
              ?>
              <table>
                <thead>
                  <th>ID</th>
                  <th>Title</th>
                  <th>Time</th>
                  <th>Excerpt</th>
                </thead>
                <tbody>
                  <?php
                    foreach($posts as $post){
                      ?>
                        <tr>
                          <td><?= htmlentities($post['ID']); ?></td>
                          <td><?= htmlentities($post['Title']); ?></td>
                          <td><?= htmlentities($post['Date']); ?></td>
                          <td><?= htmlentities($post['Excerpt']); ?></td>
                        </tr>
                      <?php
                    }
                  ?>
                </tbody>
              </table>
              <?php
            }else{
              echo "No posts";
            }
          }else{
            echo "No Posts available...";
          }
          break;
      }
      return;
    }
    function readItem($arguments){
      if(count($arguments) > 0){
        //echo "Opening \"".get_post_field('post_title', $arguments[0])."\"...<br /><br />";
        //echo get_post_field('post_content', $arguments[0]);
        $post = get_post($arguments[0]);
        $content = apply_filters('the_content', $post->post_content);
        echo "<div class=\"post\"><h1>".get_post_field('post_title', $arguments[0])."</h1>";
        echo $content . "</div>";
      }else{
        echo "Invalid amount of arguments given.<br />";
        echo htmlentities("Usage: read <post ID>");
      }
      return;
    }
    function invalidCommand($command){
      return "Invalid command: " . htmlentities($command) . "<br />Type ? or help for help.";
    }
  }
