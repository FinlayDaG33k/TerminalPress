<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes() ?>>
	<head profile="http://gmpg.org/xfn/11">
    <title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php bloginfo("template_url"); ?>/style.css">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <!-- Send keyboard inputs directly to the command line -->
    <script>
      $(function(){
				var currentDir = "~";
        $("html").keypress(function(event) {
          $("#command").focus();
        });
        /* Run a command! */
        $("#commandLine").submit(function(event) {
          event.preventDefault();
					$("#content").append("<?php if(!empty(wp_get_current_user()->user_login)){ echo htmlentities(wp_get_current_user()->user_login);}else{ echo "guest"; } ?>@<?= bloginfo('name'); ?>:/"+currentDir+"$ " + $("#command").val() + "<br />");
          console.log("User send command! " + $("#command").val());
					var command = $('#command').val().split(/\b\s+/)[0];
					console.log(command);
          switch(command){
						case "cd":
							$("#content").append("This function is still a work in progress!<br />");

							switch($('#command').val().split(/\b\s+/)[1]){
								case "..":
									currentDir = "~";
									break;
								default:
									if(typeof $('#command').val().split(/\b\s+/)[1] == 'undefined'){
										currentDir = "~";
									}else{
										currentDir = $('#command').val().split(/\b\s+/)[1];
									}
									break;
							}
							$('#dir').html("<?php if(!empty(wp_get_current_user()->user_login)){ echo htmlentities(wp_get_current_user()->user_login);}else{ echo "guest"; } ?>@<?= bloginfo('name'); ?>:/"+currentDir+"$");
							$('#currentDir').val(currentDir);
							break;
						case "clear":
							$('#content').empty();
							break;
						default:
							let data = $(this).serialize();
	            $.ajax({
	              type: "POST",
	              url: "<?= htmlentities(get_site_url()); ?>",
	              data: data,
	              success: function(data){
	                $("#content").append(data + "<br />");
	              }
	            });
						break;
					}

          $('#command').val('');
          $("html, body").animate({ scrollTop: $(document).height() }, 1000);
        });
      });
    </script>
	</head>
  <body>
    <!-- the content will be dynamically loaded with AJAX -->
    <div id="content">
      <pre>
___________                  .__              .__ __________
\__    ___/__________  _____ |__| ____ _____  |  |\______   \_______   ____   ______ ______
  |    |_/ __ \_  __ \/     \|  |/    \\__  \ |  | |     ___/\_  __ \_/ __ \ /  ___//  ___/
  |    |\  ___/|  | \/  Y Y  \  |   |  \/ __ \|  |_|    |     |  | \/\  ___/ \___ \ \___ \
  |____| \___  >__|  |__|_|  /__|___|  (____  /____/____|     |__|    \___  >____  >____  >
             \/            \/        \/     \/                            \/     \/     \/
-------------------------------------------------------------------------------------------
Version: 0.1 by FinlayDaG33k
Welcome, <?php if(!empty(wp_get_current_user()->user_login)){ echo htmlentities(wp_get_current_user()->user_login);}else{ echo "guest"; } ?>!

Type ? for a list of commands!
      </pre>
    </div>

    <!-- people will use this crap to nagivate the site :D -->
    <div id="bottom">
      <hr>
      <!-- the actual command line -->
      <form id="commandLine">
        <div class="row">
          <span class="leftText" id="dir"><?php if(!empty(wp_get_current_user()->user_login)){ echo htmlentities(wp_get_current_user()->user_login);}else{ echo "guest"; } ?>@<?= bloginfo('name'); ?>:~$ </span>
          <input type="text" id="command" name="command">
					<input type="hidden" name="currentDir" id="currentDir" value="~">
          <input type="submit" style="display:none">
        </div>
      </form>
    </div>
  </body>
</html>
