// Manter o footer no rodapé

document.addEventListener("DOMContentLoaded", function () {
    window.voltarAoTopoIndex = function () {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    };

    var footer = document.querySelector("footer");
    function updateFooter() {
        var pageHeight = document.documentElement.scrollHeight;
        var windowHeight = window.innerHeight;

        if (pageHeight <= windowHeight) {
            footer.style.position = "fixed";
        } else {
            footer.style.position = "relative";
        }

        footer.style.bottom = "0";
        footer.style.width = "100%";
    }

    updateFooter();

    window.addEventListener("resize", updateFooter);
    window.addEventListener("load", updateFooter);
});

// Data e Hora Sincronizadas

function atualizarHora() {
    var agora = new Date();
    var dia = String(agora.getDate()).padStart(2, '0');
    var mes = String(agora.getMonth() + 1).padStart(2, '0'); // Janeiro é 0!
    var ano = agora.getFullYear();
    var horas = String(agora.getHours()).padStart(2, '0');
    var minutos = String(agora.getMinutes()).padStart(2, '0');
    var segundos = String(agora.getSeconds()).padStart(2, '0');
    
    var data = dia + '/' + mes + '/' + ano
    var hour = horas + ':' + minutos + ':' + segundos;
    document.getElementById('Data').innerHTML = data;
    document.getElementById('Hora').innerHTML = hour;
}
setInterval(atualizarHora, 1000);

// Método posto para trazer prontuários específicos

function verProntuario(id, nome) {
    document.getElementById("id_paciente").value = id;
    document.getElementById("nome_paciente").value = nome;
    document.getElementById("hiddenForm").submit();
    return false;
}

$(document).ready(function(){
    // Ocultar la alerta después de 4 segundos
    setTimeout(function(){
        $('#myAlert').alert('close');
    }, 4000);
});


document.querySelectorAll('.editar-pront').forEach(button => {
    button.addEventListener('click', function() {
        const id = this.value;
        document.getElementById('modal-content').textContent = 'ID: ' + id;
        $('#myModal').modal('show');
    });
});


document.addEventListener("DOMContentLoaded", function() {
    var myModal = document.getElementById('myModal');
    myModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;
        var action = button.getAttribute('data-action');
        var modalTitle = myModal.querySelector('.modal-title');
        var doencaInput = myModal.querySelector('select[name="doencaID"]');
        var editInput = myModal.querySelector('input[name="edit"]');
        var statusSelect = myModal.querySelector('select[name="statusDoenca"]');
        var obitoSelect = myModal.querySelector('select[name="obito"]');
        var obito;

        if (action === 'edit') {
            var valorObito = button.getAttribute('data-obito');
            if (valorObito === 'N') {
                obito = 0;
            } else if (valorObito === 'S') {
                obito = 1;
            }
            modalTitle.textContent = 'Editar Prontuário';
            doencaInput.value = button.getAttribute('data-doenca');
            statusSelect.value = button.getAttribute('data-status');
            editInput.value = button.getAttribute('data-id');
            obitoSelect.value = obito;
        } else {
            modalTitle.textContent = 'Criar Prontuário';
            doencaInput.value = '';
            statusSelect.value = 'Suspeito';
            obitoSelect.value = '0';
        }
    });
});

document.addEventListener("DOMContentLoaded", function() {
    var ModalPaciente = document.getElementById('modalPaciente');
    ModalPaciente.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;
        var action = button.getAttribute('data-action');
        var modalTitle = ModalPaciente.querySelector('.modal-title');
        var nomePacienteInput = ModalPaciente.querySelector('input[name="nomePaciente"]');
        var idadeInput = ModalPaciente.querySelector('input[name="idade"]');
        var sexoInput = ModalPaciente.querySelector('select[name="sexo"]');
        var cidadeInput = ModalPaciente.querySelector('input[name="cidade"]');
        var estadoInput = ModalPaciente.querySelector('select[name="estado"]');
        var cpfInput = ModalPaciente.querySelector('input[name="cpf"]');
        var emailInput = ModalPaciente.querySelector('input[name="email"]');
        var telefoneInput = ModalPaciente.querySelector('input[name="telefone"]');
        var editInput = ModalPaciente.querySelector('input[name="edit"]');
        var btnmodalInput = ModalPaciente.querySelector('button[name="btn-modal"]');

        if (action === 'edit') {
            modalTitle.textContent = 'Editar Paciente';
            btnmodalInput.textContent = 'Salvar Alterações'
            editInput.value = button.getAttribute('data-id');
            nomePacienteInput.value = button.getAttribute('data-nome');
            emailInput.value = button.getAttribute('data-email');
            idadeInput.value = button.getAttribute('data-idade');
            sexoInput.value = button.getAttribute('data-sexo');
            cidadeInput.value = button.getAttribute('data-cidade');
            estadoInput.value = button.getAttribute('data-estado');
            cpfInput.value = button.getAttribute('data-cpf');
            telefoneInput.value = button.getAttribute('data-telefone');
        } else {
            modalTitle.textContent = 'Cadastro de Novos Pacientes';
            btnmodalInput.textContent = 'Cadastrar'
            nomePacienteInput.value = '';
            idadeInput.value = '';
            sexoInput.value = '';
            cidadeInput.value = '';
            estadoInput.value = '';
            cpfInput.value = '';
            emailInput.value = '';
            telefoneInput.value = '';
            editInput.value = '';
        }
    });
});