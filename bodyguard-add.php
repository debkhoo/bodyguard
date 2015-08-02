<?php 

	include('header.php');
?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Bodyguard
                            <small>New Bodyguard</small>
                        </h1>
                    </div>
                </div>
                 <!-- /.row -->

                <div class="row">
                    <div class="col-lg-6">

                        <form role="form" action="add-bodyguard.php" method="POST" enctype="multipart/form-data">

                            
                            <div class="form-group">
                                <label>Name</label>
                                <input name="name" class="form-control" placeholder="John Doe" required>
                            </div>
                            
                            <div class="form-group">
                                <label>Birthday</label>
                                <input name="birthday" class="form-control" placeholder="1990-05-31" required>
                            </div>
                            
                            <div class="form-group">
                                <label>Contact No:</label>
                                <input name="contact" class="form-control" placeholder="0123456789" required>
                            </div>
                            
                            <div class="form-group">
                                <label>Email</label>
                                <input name="email" type="email" class="form-control" placeholder="email@example.com" required>
                            </div>
                            
                            <div class="form-group">
                                <label>Password</label>
                                <input name="password" class="form-control" placeholder="Password" required>
                            </div>
                            
                            <div class="form-group">
                                <label>Short Description</label>
                                <textarea name="desc" class="form-control" rows="3" maxlength="300" required></textarea>
                                <p class="help-block">Max of 300 characters.</p>
                            </div>

                            
                            <div class="form-group">
                                <label>Height (cm)</label>
                                <input name="height" class="form-control" placeholder="180" required>
                            </div>
                            
                            <div class="form-group">
                                <label>Weight (kg)</label>
                                <input name="weight" class="form-control" placeholder="80" required>
                            </div>

                            
                            <div class="form-group">
                                <label>Bodyguard Picture</label>
                                <input name="photo" type="file" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="grade">Grade</label>
                                <select name="grade" class="form-control">
									<?php 
										$query = "SELECT * FROM `bodyguard_grade`";
										if ($result = $mysqli->query($query)) {
											while ($data = $result->fetch_assoc()) {
												echo '<option value="' . $data['id'] . '">' . $data['name'] . '</option>';
											}
										} else {
											echo '<option>Error retrieving ranks</option>';
										}
									?>
                                </select>
                            </div>
                            
                            <button type="reset" class="btn btn-danger">Reset</button>
							<button type="submit" class="btn btn-primary">Submit</button>

                        </form>

                    </div>
                   
                </div>
                
                 <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php

	include('footer.php');
	
?>
