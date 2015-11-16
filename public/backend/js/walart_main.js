$(function() {
    $('#side-menu').metisMenu();
});

//Loads the correct sidebar on window load,
//collapses the sidebar on window resize.
// Sets the min-height of #page-wrapper to window size
$(function() {
    $(window).bind("load resize", function() {
        topOffset = 50;
        width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width < 768) {
            $('div.navbar-collapse').addClass('collapse');
            topOffset = 100; // 2-row-menu
        } else {
            $('div.navbar-collapse').removeClass('collapse');
        }

        height = ((this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height) - 1;
        height = height - topOffset;
        if (height < 1) height = 1;
        if (height > topOffset) {
            $("#page-wrapper").css("min-height", (height) + "px");
        }
    });

    var url = window.location;
    var element = $('ul.nav a').filter(function() {
        return this.href == url;
        //return this.href == url || url.href.indexOf(this.href) == 0;
    }).addClass('active');
    /*var element = $('ul.nav a').filter(function() {
        return this.href == url || url.href.indexOf(this.href) == 0;
    }).addClass('active').parent().parent().addClass('in').parent();*/
    if (element.is('li')) {
        element.addClass('active');
    }
});

$('body').on('click', 'a.btn, button.btn, input.btn, label.btn', function(e) { 

    element = $(this);

    if(element.find(".md-click-circle").length == 0) {
        element.prepend("<span class='md-click-circle'></span>");
    }
        
    circle = element.find(".md-click-circle");
    circle.removeClass("md-click-animate");
    
    if(!circle.height() && !circle.width()) {
        d = Math.max(element.outerWidth(), element.outerHeight());
        circle.css({height: d, width: d});
    }
    
    x = e.pageX - element.offset().left - circle.width()/2;
    y = e.pageY - element.offset().top - circle.height()/2;
    
    circle.css({top: y+'px', left: x+'px'}).addClass("md-click-animate");

    setTimeout(function() {
        circle.remove();      
    }, 1000);
});

    function simbanicGridWidth(griddefs, field, table_id)
    {
        field = field || false;
        table_id = table_id || false;
        
        if(griddefs)
        {
            var tr = 1;
            for(var key in griddefs)
            {
                if(griddefs[key].hasOwnProperty('default'))
                {
                    if(griddefs[key]['default'])
                    {
                        if(griddefs[key].hasOwnProperty('width'))
                        {
                            if(table_id != '')
                            {
                                jQuery('#'+ table_id +' tr th:nth-child('+ tr +')').css('width', griddefs[key]['width']);
                            }
                            else
                            {
                                jQuery('table tr th:nth-child('+ tr +')').css('width', griddefs[key]['width']);
                            }
                        }
                        if(field)
                        {
                            jQuery('table tbody > tr td:nth-child('+ tr +')').attr("data-simba-field", key);
                        }
                        tr++;
                    }

                }
            }
        }
    }

    function simbanicGridAttribute(simbanic_rows, table_name, row_id)
    {
        if(simbanic_rows)
        {
            var r = 1;
            for(var row_key in simbanic_rows)
            {
                var simbanic_td = simbanic_rows[row_key];

                jQuery('table tbody tr').attr('data-simba-table', table_name);
                jQuery('table tbody > tr:nth-child('+ r +')').attr("data-simba-id", simbanic_rows[row_key][row_id]);

                r++;
            }
        }
    }

    function responseSuccess(success_message)
    {
        jQuery('.success, .warning, .attention, .information, .error').remove();

        jQuery('#notification').html('<div class="success" style="display: none;">' + success_message + '</div>');
            
        jQuery('.success').fadeIn('slow');

        setTimeout(function() {
            jQuery('.success').fadeOut('slow');
        }, 2000);
    }

    function simbanicRemove(table_name, record)
    {
        if(confirm("Are you sure?"))
        {
            var delete_data = { deleted: 1 };

            jQuery.ajax({
                url: base_url + 'grid/onclick/update/'+ table_name +'/' + record,
                type: 'POST',
                data: delete_data,
                success:function(json) {

                    if(json['error'])
                    {
                        alert(json['error']);
                    }

                    if(json['success'])
                    {
                        responseSuccess('Deleted Successfully');
                        simbanic_grid_list.bootgrid('reload');
                    }

                }
            });
        }
    }
