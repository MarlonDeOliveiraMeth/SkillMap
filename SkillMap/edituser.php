<!-- Formulário para o usuário atualizar algumas informações do seu perfil. -->
<?php
    $query = mysqli_query($conn,"SELECT * FROM `users` WHERE userid='$_SESSION[userid]' ")or die(mysqli_error($conn));
    $row = mysqli_fetch_array($query);
    $jobtitle = $row['jobtitle'];
    $graduation = $row['graduation'];
    $hobbies = $row['hobbies'];
?>
<div class="modal fade" id="edituser" tabindex="-1" aria-labelledby="edituserLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 15px;">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="edituserLabel" style="font-family: Luckiest Guy;">Atualize os seus dados</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form action="sendedituser.php" method="post" enctype="multipart/form-data" autocomplete="off">
                        <label for="jobtitle">Cargo atual</label>
                        <input class="form-control" type="text" name="jobtitle" id="jobtitle" value="<?php echo $jobtitle; ?>" required/>
                        </br>
                        <label for="email">Formação</label>
                        <input class="form-control" type="text" name="graduation" id="graduation" value="<?php echo $graduation; ?>" required/>
                        </br>
                        <label for="hobbies">Hobbies</label>
                        <!-- Obtém todos os hobbies do banco de dados. -->
                        <select class="form-select" type="text" name="hobbies[]" id="hobbies" multiple required>
                            <option value="<?php echo $hobbies; ?>" selected hidden><?php echo $hobbies; ?></option>
                            <?php
                            $sql = mysqli_query($conn, "SELECT * FROM `hobby` ORDER BY hobbyid");
                            while ($row = mysqli_fetch_array($sql)) 
                            {
                                $allhobbies = $row['allhobbies'];
                            ?>
                            <option value="<?php echo $allhobbies; ?>"><?php echo $allhobbies; ?></option>
                            <?php 
                            } 
                            ?>
                        </select>
                        </br>
                        <button type="submit" name="Submit" class="btn btn-success shadow" style="border-radius: 100px; display:block; margin: 0 auto; font-family: Luckiest Guy;">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Select de hobbies. -->
<script>
    var select_box_element = document.querySelector('#hobbies');
    dselect(select_box_element, {
        search: true,
        maxHeight: '200px',
    });
</script>