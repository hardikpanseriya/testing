
<?php

if(isset($tree_result) && !empty($tree_result))
{
	$tree_json = json_encode($tree_result);
}
?>
<div class="simba_customer_tree col-md-12">
  <svg id="svg-canvas" width="960" height="500" ></svg>
</div>

<?php $this->load->view( BACKEND . '/common/footer'); ?>

<script id="js">
  
// Create the input graph
var g = new dagreD3.graphlib.Graph()
  .setGraph({})
  .setDefaultEdgeLabel(function() { return {}; });

var tree_json = <?= $tree_json; ?>;
var simba_sponsor_id = '<?= $sponsor_id; ?>';

tree_json.forEach(function(obj)
{
  var noder = obj.sponsor_id + '_' + obj.customer_id;
  g.setNode(obj.customer_id,  { label: '<span data-simba="'+ noder +'" id="'+ obj.customer_id +'" class="simba_span_node">' + obj.full_name + '<hr/> ' + obj.customer_id + ' </span><hr/> Unit: ' + obj.unit + '<hr/><a class="node_hide" id="'+ obj.customer_id +'" onclick="return hideNode(this)">Hide</a>' , class: "simba_node", id: obj.customer_id, style: "fill: #afa", labelType: "html" });
  if(obj.sponsor_id != simba_sponsor_id)
  {
    g.setEdge(obj.sponsor_id, obj.customer_id, {
      lineInterpolate: 'basis',
    });
  }
});


// Create the renderer
var render = new dagreD3.render();

// Set up an SVG group so that we can translate the final graph.
var svg = d3.select("svg"),
    svgGroup = svg.append("g");

// Run the renderer. This is what draws the final graph.
render(d3.select("svg g"), g);

var edgePath = svg.selectAll(".edgePath .path")
//.attr("class", function(d) { return "link " + d.relation; })
.attr("data-simba-arrow",function(d, i) {
    var arrow_id = jQuery('span#'+d.w).attr('data-simba');
    return arrow_id;
  });

var svg_width = svg.attr("width");
var graph_width = g.graph().width;
if(graph_width >= svg_width)
{
  svg.attr("width", graph_width + 50);
  jQuery("svg").parent().addClass('simba_tree_overflow');
}
// Center the graph
var xCenterOffset = (svg.attr("width") - g.graph().width) / 2;
svgGroup.attr("transform", "translate(" + xCenterOffset + ", 20)");
svg.attr("height", g.graph().height + 40);

</script>

<script type="text/javascript">

  function hideNode(node)
  { 
    var node_id = jQuery(node).attr('id');
    var node_all_span = jQuery('.simba_customer_tree').find('span[data-simba*="'+node_id+'_"]');
    var node_parent_g = node_all_span.closest('.simba_node');
    node_parent_g.remove();

    var arrow_all_path = jQuery('.simba_customer_tree').find('path[data-simba-arrow*="'+node_id+'_"]');
    var arrow_parent_g = arrow_all_path.closest('.edgePath');
    arrow_parent_g.remove();
    //console.log(jQuery('.simba_customer_tree').find('span[data-simba*="'+node_id+'"]'));
    //jQuery('.simba_node.'+node_id).remove();
    //jQuery('.'+node_id).parent().remove();
    //var child = d3.selectAll(".node").data();
    //console.log(child);
    //console.log(jQuery(node).parent().parent().parent().parent().parent());
    //console.log(d3.select("g.parent"));
    //render(svg.selectAll("*").remove());
    // Run the renderer. This is what draws the final graph.
  }
  function SingleClickHandler(click)
  {
    
  }

	jQuery('.simba_span_node').live('click', function(){
	  var node_id = jQuery(this).attr('id');
    var simba_node_id = jQuery(this).attr('data-simba');

    //var node_id = node_id_id.substr(node_id_id.length - 7);
    jQuery.ajax({
        type      : 'POST',
        url       : base_url + 'backend/customer_controller/get_customer_tree_data',
        data      : { node_id: node_id },
        dataType  : 'json',
        success   : function(data) {
          if(data)
          {
            dagre_node(simba_node_id, data);
          }
          else
          {
            alert('Record not found.');
          }
        }
    });
	});

	function dagre_node(simba_node_id, node)
	{
      node.forEach(function(obj)
      {
        //console.log('g.setNode('+ obj.customer_id +')');
        var noder = simba_node_id + '_' + obj.customer_id;
        g.setNode(obj.customer_id,  { label: '<span data-simba = "'+ noder +'" id="'+ obj.customer_id +'" class="simba_span_node">' + obj.full_name + '<hr/> ' + obj.customer_id + ' </span><hr/> Unit: ' + obj.unit + '<hr/><a class="node_hide" id="'+ obj.customer_id +'" onclick="return hideNode(this)">Hide</a>' , class: "simba_node "+ simba_node_id +"", id: obj.customer_id, style: "fill: #afa", labelType: "html" });

        //g.setNode(obj.customer_id,  { label: obj.full_name + ' <hr/> ' + obj.customer_id + ' ', class: "simba_node node_done "+ node_id +"", id: obj.customer_id, style: "fill: #afa", labelType: "html" });
        if(obj.sponsor_id != 0)
        {
          //console.log('g.setEdge('+ obj.sponsor_id + ', ' + obj.customer_id +')');
          g.setEdge(obj.sponsor_id, obj.customer_id, {
            lineInterpolate: 'basis' 
          });
        }
      });

    // Run the renderer. This is what draws the final graph.
    render(d3.select("svg g"), g);

    var edgePath = svg.selectAll(".edgePath .path")
                  .attr("class", function(d) { return "path "+d.v })
                  .attr("data-simba-arrow",function(d, i) {
                    var arrow_id = jQuery('span#'+d.w).attr('data-simba');
                    return arrow_id;
                  });

    var svg_width = svg.attr("width");
    var graph_width = g.graph().width;
    if(graph_width >= svg_width)
    {
      svg.attr("width", graph_width + 50);
      jQuery("svg").parent().addClass('simba_tree_overflow');
    }
    
    // Center the graph
    var xCenterOffset = (svg.attr("width") - g.graph().width) / 2;
    svgGroup.attr("transform", "translate(" + xCenterOffset + ", 20)");
    svg.attr("height", g.graph().height + 40);
	}
</script>