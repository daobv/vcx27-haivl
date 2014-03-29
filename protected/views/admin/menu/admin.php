<?php
$this->breadcrumbs=array(
	'Manage Menus',
);
?>
<div style="margin-bottom: 20px; margin-left: 30px;" >
    <div style="float:left">
        <input id="reload"  type="button" style="display:block; clear: both;" value="Refresh"class="client-val-form button">
    </div>
    <div style="float:left">
        <input id="add_root" type="button" style="display:block; clear: both;" value="Thêm mới" class="client-val-form button">
    </div>
</div>
<div style="float: left; margin-left: 30px;">
<!--The tree will be rendered in this div-->
<div id="<?php echo Menu::ADMIN_TREE_CONTAINER_ID; ?>"></div>
<script type="text/javascript">
    $(function () {
        $("#<?php echo Menu::ADMIN_TREE_CONTAINER_ID; ?>")
        .jstree({
            "html_data" : {
                "ajax" : {
                    "type":"POST",
                    "url" : "<?php echo Yii::app()->getBaseUrl(); ?>/admin.php/menu/fetchTree",
                    "data" : function (n) {
                        return {
                            id : n.attr ? n.attr("id") : 0,
                            "YII_CSRF_TOKEN":"<?php echo Yii::app()->request->csrfToken; ?>"
                        };
                    }
                }
            },
            
            "contextmenu":  { 'items': {
                    
                    "rename" : {
                        "label" : "Rename",
                        "action" : function (obj) { this.rename(obj); }
                    },
                    "update" : {
                        "label"	: "Update",
                        "action"	: function (obj) {
                            id=obj.attr("id").replace("node_","");
                            level=obj.attr("level");
                            $.ajax({
                                type: "POST",
                                url: "<?php echo Yii::app()->getBaseUrl(); ?>/admin.php/menu/returnForm",
                                data:{
                                    'update_id':  id,
                                    "YII_CSRF_TOKEN":"<?php echo Yii::app()->request->csrfToken; ?>"
                                },
                                'beforeSend' : function(){
                                    $("#<?php echo Menu::ADMIN_TREE_CONTAINER_ID; ?>").addClass("ajax-sending");
                                },
                                'complete' : function(){
                                    $("#<?php echo Menu::ADMIN_TREE_CONTAINER_ID; ?>").removeClass("ajax-sending");
                                },
                                success :  function(data){
                                    $.fancybox(data,
                                         {})//fancybox
                                } //function
                            });//ajax
                            
                        }//action function
                        
                    },//update
                    
                    "properties" : {
                        "label"	: "Properties",
                        "action" : function (obj) {
                            id=obj.attr("id").replace("node_","")
                            $.ajax({
                                type:"POST",
                                url:"<?php echo Yii::app()->getBaseUrl(); ?>/admin.php/menu/returnView",
                                data:   {
                                    "id" :id,
                                    "YII_CSRF_TOKEN":"<?php echo Yii::app()->request->csrfToken; ?>"
                                },
                                beforeSend : function(){
                                    $("#<?php echo Menu::ADMIN_TREE_CONTAINER_ID; ?>").addClass("ajax-sending");
                                },
                                complete : function(){
                                    $("#<?php echo Menu::ADMIN_TREE_CONTAINER_ID; ?>").removeClass("ajax-sending");
                                },
                                success :  function(data){
                                    $.fancybox(data,
                                         {})//fancybox
                                } //function
                                
                                
                                
                            });//ajax
                            
                        },
                        "_class"			: "class",	// class is applied to the item LI node
                        "separator_before"	: false,	// Insert a separator before the item
                        "separator_after"	: true	// Insert a separator after the item
                        
                    },//properties
                    
                    "remove" : {
                        "label"	: "Delete",
                        "action" : function (obj) {
                            if(!confirm((obj).attr('rel')+' and all it\'s subcategories will be deleted. Are you sure ?')) return false;
                            jQuery("#<?php echo Menu::ADMIN_TREE_CONTAINER_ID; ?>").jstree("remove",obj);
                            }
                    },//remove
                                         "create" : {
                                             "label"	: "Create",
                                             "action" : function (obj) { this.create(obj); },
                                             "separator_after": false
                                         }                                 
                                     }//items
                                 },//context menu
                                 
                                 // the `plugins` array allows you to configure the active plugins on this instance
                                 "plugins" : ["themes","html_data","contextmenu","crrm","dnd"],
                                 // each plugin you have included can have its own config object
                                 "core" : { "initially_open" : [ <?php echo $this->open_nodes ?> ],'open_parents':true}
                                 // it makes sense to configure a plugin only if overriding the defaults
                                 
                             })
                             
                             ///EVENTS
                             .bind("rename.jstree", function (e, data) {
                                 $.ajax({
                                     type:"POST",
                                     url:"<?php echo Yii::app()->getBaseUrl(); ?>/admin.php/menu/rename",
                                     data:  {
                                         "id" : data.rslt.obj.attr("id").replace("node_",""),
                                         "new_name" : data.rslt.new_name,
			                 "YII_CSRF_TOKEN":"<?php echo Yii::app()->request->csrfToken; ?>"
                                     },
                                     beforeSend : function(){
                                         $("#<?php echo Menu::ADMIN_TREE_CONTAINER_ID; ?>").addClass("ajax-sending");
                                     },
                                     complete : function(){
                                         $("#<?php echo Menu::ADMIN_TREE_CONTAINER_ID; ?>").removeClass("ajax-sending");
                                     },
                                     success:function (r) {  response= $.parseJSON(r);
                                         if(!response.success) {
                                             $.jstree.rollback(data.rlbk);
                                         }else{
                                             data.rslt.obj.attr("rel",data.rslt.new_name);
                                         };
                                     }
                                 });
                             })
                             
                             .bind("remove.jstree", function (e, data) {
                                 $.ajax({
                                     type:"POST",
                                     url:"<?php echo Yii::app()->getBaseUrl(); ?>/admin.php/menu/remove",
                                     data:{
                                         "id" : data.rslt.obj.attr("id").replace("node_",""),
                                         "YII_CSRF_TOKEN":"<?php echo Yii::app()->request->csrfToken; ?>"
                                     },
                                     beforeSend : function(){
                                         $("#<?php echo Menu::ADMIN_TREE_CONTAINER_ID; ?>").addClass("ajax-sending");
                                     },
                                     complete: function(){
                                         $("#<?php echo Menu::ADMIN_TREE_CONTAINER_ID; ?>").removeClass("ajax-sending");
                                     },
                                     success:function (r) {  response= $.parseJSON(r);
                                         if(!response.success) {
                                             $.jstree.rollback(data.rlbk);
                                         };
                                     }
                                 });
                             })
                             
                             .bind("create.jstree", function (e, data) {
                                 newname=data.rslt.name;
                                 parent_id=data.rslt.parent.attr("id").replace("node_","");
                                 $.ajax({
                                     type: "POST",
                                     url: "<?php echo Yii::app()->getBaseUrl(); ?>/admin.php/menu/returnForm",
                                     data:{   'name': newname,
                                         'parent_id':   parent_id,
                                         "YII_CSRF_TOKEN":"<?php echo Yii::app()->request->csrfToken; ?>"
                                     },
                                     beforeSend : function(){
                                         $("#<?php echo Menu::ADMIN_TREE_CONTAINER_ID; ?>").addClass("ajax-sending");
                                     },
                                     complete : function(){
                                         $("#<?php echo Menu::ADMIN_TREE_CONTAINER_ID; ?>").removeClass("ajax-sending");
                                     },
                                     success: function(data){
                                         
                                         $.fancybox(data,
                                         {})//fancybox
                                         
                                     } //success
                                 });//ajax
                                 
                             })
                             .bind("move_node.jstree", function (e, data) {
                                 data.rslt.o.each(function (i) {
                                     
                                     //jstree provides a whole  bunch of properties for the move_node event
                                     //not all are needed for this view,but they are there if you need them.
                                     //Commented out logs  are for debugging and exploration of jstree.
                                     
                                     next= jQuery.jstree._reference('#<?php echo Menu::ADMIN_TREE_CONTAINER_ID; ?>')._get_next (this, true);
                                     previous= jQuery.jstree._reference('#<?php echo Menu::ADMIN_TREE_CONTAINER_ID; ?>')._get_prev(this,true);
                                     
                                     pos=data.rslt.cp;
                                     moved_node=$(this).attr('id').replace("node_","");
                                     next_node=next!=false?$(next).attr('id').replace("node_",""):false;
                                     previous_node= previous!=false?$(previous).attr('id').replace("node_",""):false;
                                     new_parent=$(data.rslt.np).attr('id').replace("node_","");
                                     old_parent=$(data.rslt.op).attr('id').replace("node_","");
                                     ref_node=$(data.rslt.r).attr('id').replace("node_","");
                                     ot=data.rslt.ot;
                                     rt=data.rslt.rt;
                                     copy= typeof data.rslt.cy!='undefined'?data.rslt.cy:false;
                                     copied_node= (typeof $(data.rslt.oc).attr('id') !='undefined')? $(data.rslt.oc).attr('id').replace("node_",""):'UNDEFINED';
                                     new_parent_root=data.rslt.cr!=-1?$(data.rslt.cr).attr('id').replace("node_",""):'root';
                                     replaced_node= (typeof $(data.rslt.or).attr('id') !='undefined')? $(data.rslt.or).attr('id').replace("node_",""):'UNDEFINED';                            
                                     
                                     $.ajax({
                                         async : false,
                                         type: 'POST',
                                         url: "<?php echo Yii::app()->getBaseUrl(); ?>/admin.php/menu/moveCopy",
                                         
                                         data : {
                                             "moved_node" : moved_node,
                                             "new_parent":new_parent,
                                             "new_parent_root":new_parent_root,
                                             "old_parent":old_parent,
                                             "pos" : pos,
                                             "previous_node":previous_node,
                                             "next_node":next_node,
                                             "copy" : copy,
                                             "copied_node":copied_node,
                                             "replaced_node":replaced_node,
                                             "YII_CSRF_TOKEN":"<?php echo Yii::app()->request->csrfToken; ?>"
                                         },
                                         beforeSend : function(){
                                             $("#<?php echo Menu::ADMIN_TREE_CONTAINER_ID; ?>").addClass("ajax-sending");
                                         },
                                         complete : function(){
                                             $("#<?php echo Menu::ADMIN_TREE_CONTAINER_ID; ?>").removeClass("ajax-sending");
                                         },
                                         success : function (r) {
                                             response=$.parseJSON(r);
                                             if(!response.success) {
                                                 $.jstree.rollback(data.rlbk);
                                                 alert(response.message);
                                             }
                                             else {
                                                 //if it's a copy
                                                 if  (data.rslt.cy){
                                                     $(data.rslt.oc).attr("id", "node_" + response.id);                         
                                                     if(data.rslt.cy && $(data.rslt.oc).children("UL").length) {
                                                         data.inst.refresh(data.inst._get_parent(data.rslt.oc));
                                                     }
                                                 }
                                                 //  console.log('OK');
                                             }
                                             
                                         }
                                     }); //ajax
                                     
                                     
                                     
                                 });//each function
                             });   //bind move event
                             
                             ;//JSTREE FINALLY ENDS (PHEW!)
                             
                             //BINDING EVENTS FOR THE ADD ROOT AND REFRESH BUTTONS.
                             $("#add_root").click(function () {
                                 $.ajax({
                                     type: 'POST',
                                     url:"<?php echo Yii::app()->getBaseUrl(); ?>/admin.php/menu/returnForm",
                                     data:	{
                                         "create_root" : true,
                                         "YII_CSRF_TOKEN":"<?php echo Yii::app()->request->csrfToken; ?>"
                                     },
                                     beforeSend : function(){
                                         $("#<?php echo Menu::ADMIN_TREE_CONTAINER_ID; ?>").addClass("ajax-sending");
                                     },
                                     complete : function(){
                                         $("#<?php echo Menu::ADMIN_TREE_CONTAINER_ID; ?>").removeClass("ajax-sending");
                                     },
                                     success:    function(data){
                                         
                                         $.fancybox(data,
                                         {})//fancybox
                                         
                                     } //function
                                     
                                 });//post
                             });//click function
                             
                             $("#reload").click(function () {
                                 jQuery("#<?php echo Menu::ADMIN_TREE_CONTAINER_ID; ?>").jstree("refresh");
                             });
                         });

</script>

</div>