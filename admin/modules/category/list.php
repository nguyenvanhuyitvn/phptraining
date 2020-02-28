<?php 
    require_once('config/connection.php');
    $sql = "SELECT * FROM category";
    $records = mysqli_query($conn, $sql);
    $total = mysqli_num_rows($records);

    // paginate
    $limit = 5;
    $total_page = ceil($total/$limit);
    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
    $start = ($current_page-1)*$limit;
    if($current_page > $total_page) {
       $current_page = $total_page;
    }
    if($current_page < 1) {
       $current_page = 1;
    }

    $query = "SELECT * FROM category ORDER BY id DESC LIMIT $start,$limit";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0){
        while($row =  mysqli_fetch_array($result)){
          $categories[] = $row;
        }
    }

?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Danh mục sản phẩm</h3>
        </div>
        <div class="card-body p-0">
          <table class="table table-striped projects">
              <thead>
                  <tr>
                      <th style="width: 1%">
                          #
                      </th>
                      <th style="width: 20%">
                          Name
                      </th>
                      <th style="width: 8%" class="text-center">
                          Status
                      </th>
                      <th style="width: 20%">
                      </th>
                  </tr>
              </thead>
              <tbody>
                <?php 
                  $i=1;
                  foreach ($categories as $key => $category) {
                 ?>
                  <tr>
                      <td>
                          <?php echo $i; ?>
                      </td>
                      <td>
                          <?php echo $category['name'] ?>
                      </td>
                      <td class="project-state">
                          <?php if($category['status'] == 1){  ?>
                            <span class="badge badge-success"><?php echo "Active"; ?></span>
                          <?php } else{ ?>
                            <span class="badge badge-danger"><?php echo "Deactive"; ?></span>
                          <?php } ?>
                      </td>
                      <td class="project-actions text-right"  style="width: 100px; text-align: center">
                          <a class="btn btn-info btn-sm" href="index.php?m=category&a=edit&id=<?php echo $category['id']; ?>">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Edit
                          </a>
                          <a class="btn btn-danger btn-sm" href="index.php?m=category&a=delete&id=<?php echo $category['id']; ?>">
                              <i class="fas fa-trash">
                              </i>
                              Delete
                          </a>
                      </td>
                  </tr>
                  <?php $i++; } ?>
              </tbody>
          </table>
        </div>
        <!-- /.card-body -->
        <div class="box-footer mt-2">
          <ul class="pagination pagination-sm float-right">
              <?php if($current_page > 1 && $total_page > 1){ ?>
                    <li class="page-item"><a class="page-link" href="index.php?m=category&page=<?php echo ($current_page -1); ?>">&laquo;</a></li>
              <?php }else{?>
                    <li class="page-item disabled" ><a class="page-link" href="" >&laquo;</a></li>
              <?php } ?>
              <?php for($i=1; $i<= $total_page; $i++){ 
                if($current_page == $i){ $active = "active";}else {
                  $active = '';
                }
              ?>
                  <li class="page-item <?php echo $active; ?>"><a class="page-link" href="index.php?m=category&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
              <?php } ?>

              <?php 
                  if($current_page < $total_page && $total_page>1){
              ?>
                  <li class="page-item"><a class="page-link" href="index.php?m=category&page=<?php echo ($current_page+1); ?>">&raquo;</a></li>
              <?php }elseif($current_page == $total_page ){?> 
                  <li class="page-item disabled"><a class="page-link" href="#">&raquo;</a></li>
              <?php } ?>
            
          </ul>
        </div>
      </div>
      <!-- /.card -->
    </section>
    <!-- /.content -->
</div>