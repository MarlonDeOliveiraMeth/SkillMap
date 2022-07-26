<!-- Formulário para o usuário adicionar uma nova skill em seu perfil. -->
<?php
    $query = mysqli_query($conn,"SELECT * FROM `users` WHERE userid='$_SESSION[userid]' ")or die(mysqli_error($conn));
    $row = mysqli_fetch_array($query);
    $fullname=$row['fullname'];
?>
<div class="modal fade" id="addskill" tabindex="-1" aria-labelledby="addskillLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 15px;">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="addskillLabel" style="font-family: Luckiest Guy;">Insira uma nova skill</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form action="sendskill.php" method="post" enctype="multipart/form-data" autocomplete="off">
					    <input type="hidden" class="form-control" name="fullname" required value="<?php echo $fullname; ?>">
                        </br>
                        <label for="skill">Skill*</label>
                        <!-- Obtém todas as skills do banco de dados. -->
                        <select type="text" class="form-select" name="skill" id="skill" required>
                            <option value="" disabled selected hidden>.</option>
                            <?php
                                $sql = mysqli_query($conn, "SELECT * FROM `skills` ORDER BY skillid");
                                while ($row = mysqli_fetch_array($sql)) 
                                {
                                    $allskills = $row['allskills'];
                            ?>
                            <option value="<?php echo $allskills; ?>"><?php echo $allskills; ?></option>
                            <?php 
                                } 
                            ?>
                        </select>
                        </br>
                        <label for="level">Level*</label>
                        <select type="text" class="form-select" name="level" id="level" required>
                            <option value="" disabled selected hidden></option>
                            <option value="Básico">Básico</option>
                            <option value="Intermediário">Intermediário</option>
                            <option value="Avançado">Avançado</option>
                        </select>
                        </br>
                        <label for="objective">Você trabalha com a skill?*</label>
                        <select type="text" class="form-select" name="objective" id="objective" required>
                            <option value="" disabled selected hidden></option>
                            <option value="Sim">Sim</option>
                            <option value="Não">Não</option>
                            <option value="Gostaria">Gostaria</option>
                        </select>
                        </br>
                        <label for="askcertify">Possui certificado?*</label>
                        <select type="text" class="form-select" name="askcertify" id="askcertify" required onchange="Certification(this.value)">
                            <option value="" disabled selected hidden></option>
                            <option value="Sim">Sim</option>
                            <option value="Não">Não</option>
                        </select>
                        </br>
                        <input type='file' class='form-control certification' name='certification' id="certification" accept='application/pdf,image/*' style="display: none">
                        </br>
                        <button type="submit" name="Submit" class="btn btn-success shadow" style="border-radius: 100px; display:block; margin: 0 auto; font-family: Luckiest Guy;">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Select de skills. -->
<script>
    var select_box_element = document.querySelector('#skill');
    dselect(select_box_element, {
        search: true,
        maxHeight: '200px',
    });
</script>
<!-- Exibe e oculta o input de certificado. -->
<script>
function Certification(option)    
{
    if(option == "Sim")
    {
        $('.certification').show()
    }
    else{
        $('.certification').hide()
    }
}
</script>