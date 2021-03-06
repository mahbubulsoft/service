<?php
    require_once "functions/function.php";
?>
<?php
    if($_SESSION['roleId'] > 4){
        header("Location:index.php");   
    }
?>
<?php
    if(isset($_GET['postDeleteId']) && $_GET['postDeleteId'] != NULL){
        $postId = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['postDeleteId']);
        $delQuery = "delete from tbl_post where post_postId='$postId'";
        if(mysqli_query($con,$delQuery)){
            $delMsg = "Post delete success";
        }else{
            $delMsg = "Post not deleted, something wrong";
        }
    }
?>
<?php
    getHeader();
    getSidebar();
    getBread();
?>
                <div class="col-md-12">
                	<div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="col-md-9 heading_title">
                                All Post Information View
                             </div>
                             <div class="col-md-3 text-right">
                             	<a href="addPost.php" class="btn btn-sm btn btn-primary"><i class="fa fa-plus-circle"></i> Add Post</a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                      <div class="panel-body">
                         <?php
                            if(isset($delMsg)){
                                echo "<span style='color:green;font-size:20px'>".$delMsg."</span>";
                            }
                        ?>
                          <table class="table table-responsive table-striped table-hover table_cus">
                          		<thead class="table_head">
                            		<tr>
                                    	<th>S.N</th>
                                    	<th>Post Title</th>
                                        <th>Post Button</th>
                                        <th>Post Type</th>
                                        <th class="hidden-xs">Post Image</th>
                                        <th class="hidden-xs">Post Details</th>
                                        <th>Manage</th>
                                    </tr>
                            	</thead>
                                <tbody>
                                 <?php
                                    $query = "SELECT * FROM tbl_post ORDER BY post_postId DESC";
                                    $result = mysqli_query($con,$query)->fetch_all(MYSQLI_ASSOC);
                                    if($result){
                                        $i=0;
                                        foreach($result as $post){
                                 ?>
                                	<tr>
                                        <td><?=++$i;?></td>
                                    	<td><?=$post['post_postTitle'];?></td>
                                        <td><?=$post['post_postButtonText'];?></td>
                                        <td><?php if($post['post_postStatus']==1){echo "Unpublish";}else{echo "Publish";}?></td>
                                        <td class="hidden-xs"><img src="uploads/postImage/<?=$post['post_postImage'];?>" alt="" style="width:70px;height:50px;"></td>
                                        <td class="hidden-xs"><?=textShorten($post['post_postDetails'],50);?>...</td>
                                        
                                        <td>
                                        	<a href="viewPost.php?postViewId=<?=$post['post_postId'];?>"><i class="fa fa-plus-square fa-lg"></i></a>
                                           <a href="editPost.php?postEditId=<?=$post['post_postId'];?>"><i class="fa fa-pencil-square fa-lg"></i></a>
                                           <?php if($_SESSION['roleId'] <= 2){ ?>
                                            <a onclick="return confirm('Are you sure to remove this post');" href="?postDeleteId=<?=$post['post_postId'];?>"><i class="fa fa-trash fa-lg"></i></a>
                                          <?php } ?>
                                        </td>
                                    </tr>
                                    <?php } } ?>
                                    
                                </tbody>
                          </table>
                      </div>
                      <div class="panel-footer">
                        <div class="col-md-4">
                        	<a href="#" class="btn btn-sm btn-warning">EXCEL</a>
                            <a href="#" class="btn btn-sm btn-primary">PDF</a>
                            <a href="#" class="btn btn-sm btn-danger">SVG</a>
                            <a href="#" class="btn btn-sm btn-success">PRINT</a>
                        </div>
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-4 text-right">
                        	<nav aria-label="Page navigation">
                              <ul class="pagination pagina_cus">
                                <li>
                                  <a href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                  </a>
                                </li>
                                <li class="active"><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li>
                                  <a href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                  </a>
                                </li>
                              </ul>
                            </nav>
                        </div>
                        <div class="clearfix"></div>
                      </div>
                    </div>
                </div><!--col-md-12 end-->
<?php
    getFooter();
?>