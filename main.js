const loader = $('.bouncing-loader');


// Login user validation via AJAX
$('.login-form').submit(function(e) {
    e.preventDefault();
    loader.css("display", "flex");
    var login = $("input[name='login']",this).val();
    var password = $("input[name='password']",this).val();
    $.ajax({
        type: "POST",
        url: "login.php",
        dataType: 'json',
        data: { login: login, password: password}
        }).done(function( data ) {
            var data = JSON.parse(data);
            if (data == 1) {
                $(".validation").html("Zalogowałeś się poprawnie, za chwilę zostaniesz przeniesiony...");
                setInterval(function(){ loader.hide(); }, 1000);
                setTimeout(' window.location.href = "admin.php"; ',1000);
            } else {
                setInterval(function(){ loader.hide(); }, 1000);
                $(".validation").html("Złe dane logowania. Spróbuj ponownie!");
            }
        });

        
});


// Set cookie via AJAX
$('.modal .close').click(function(e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "modal.php",
        }).done(function( data ) {
            $(".modal").fadeOut();
            $(".bgr-modal").fadeOut();
        });

        
});

// Display login box
$(".login").click(function (e) { 
    e.preventDefault();
    $(".login-page").fadeIn();
    $(".bgr").fadeIn();
    $(".login-page .close").click(function (e) { 
        e.preventDefault();
        $(".login-page").fadeOut();
        $(".bgr").fadeOut();
    });
});

// Menu tabs in admin panel
function tabs() {
    $('.tab-list').each(function(){
        var $this = $(this);
        var $tab = $this.find('li.active');
        var $link = $tab.find('a'); 
        var $panel = $($link.attr('href'));
      
        $this.on('click', '.tab-control', function(e) { 
          e.preventDefault();
          var $link = $(this), 
              id = this.hash; 
      
          if (id && !$link.is('.active')) { 
            $panel.removeClass('active'); 
            $tab.removeClass('active'); 
      
            $panel = $(id).addClass('active');
            $tab = $link.parent().addClass('active'); 
          }
        });
      });
}

tabs();