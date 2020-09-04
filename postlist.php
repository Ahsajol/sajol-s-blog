<?php include 'inc/adminheader.php'; ?>
<?php include 'inc/adminsidebar.php'; ?>

<div class="grid_10">
	<div class="box round first grid">
		<h2>Post List</h2>
		<div class="block">
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th width="05%">No</th>
						<th width="10%">Title</th>
						<th width="23%">Description</th>
						<th width="10%">Category</th>
						<th width="12%">Image</th>
						<th width="10%">Author</th>
						<th width="08%">Tags</th>
						<th width="10%">Date</th>
						<th width="12%">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$query = "SELECT tbl_post.*,tbl_category.name FROM tbl_post
						INNER JOIN tbl_category ON tbl_post.cat = tbl_category.id
						ORDER BY tbl_post.title DESC";
					$post = $db->SELECT($query);
					if ($post) {
						$i = 0;
						while ($result = $post->fetch_assoc()) {
							$i++;
					?>
							<tr class="odd gradeX">
								<td><?php echo $i; ?></td>
								<td><a href="editpost.php?editpostid=<?php echo $result['id']; ?>"><?php echo $result['title']; ?></a></td>
								<td><?php echo $fm->textshorten($result['body'], 200); ?></td>
								<td><?php echo $result['name']; ?></td>
								<td><img src="<?php echo $result['image']; ?>" height="40px" width="60px" /></td>
								<td><?php echo $result['author']; ?></td>
								<td><?php echo $result['tags']; ?></td>
								<td><?php echo $fm->formatdate($result['date']); ?></td>
								<td><a href="editpost.php?editpostid=<?php echo $result['id']; ?>" class="btn">Edit</a>
									<a onclick="return confirm('Are You Sure to Delete This Post!!');" href="deletepost.php?deletepostid =<?php echo $result['id']; ?>" class="btn">Delete</a>
								</td>
							</tr>
					<?php }
					} ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		setupLeftMenu();
		$('.datatable').dataTable();
		setSidebarHeight();
	});
</script>

<?php include 'inc/adminfooter.php'; ?>