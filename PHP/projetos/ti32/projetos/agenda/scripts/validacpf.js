
function validarCPF(cpf) {
    cpf = cpf.replace(/[^\d]+/g, ''); // Remove caracteres não numéricos

    // Verifica se o CPF tem 11 dígitos
    if (cpf.length !== 11) {
        return false;
    }

    // Verifica se todos os dígitos são iguais (ex: 111.111.111-11)
    // Isso evita CPFs inválidos óbvios como 000.000.000-00, 111.111.111-11, etc.
    if (/^(\d)\1{10}$/.test(cpf)) {
        return false;
    }

    let soma;
    let resto;

    // Validação do primeiro dígito verificador
    soma = 0;
    for (let i = 0; i < 9; i++) {
        soma += parseInt(cpf.charAt(i)) * (10 - i);
    }
    resto = 11 - (soma % 11);
    if (resto === 10 || resto === 11) {
        resto = 0;
    }
    if (resto !== parseInt(cpf.charAt(9))) {
        return false;
    }

    // Validação do segundo dígito verificador
    soma = 0;
    for (let i = 0; i < 10; i++) {
        soma += parseInt(cpf.charAt(i)) * (11 - i);
    }
    resto = 11 - (soma % 11);
    if (resto === 10 || resto === 11) {
        resto = 0;
    }
    if (resto !== parseInt(cpf.charAt(10))) {
        return false;
    }

    return true; // Se chegou até aqui, o CPF é válido
}

// --- Exemplos de Uso ---

// Exemplo 1: CPF Válido
const cpfValido = "123.456.789-00";
if (validarCPF(cpfValido)) {
    console.log(`CPF "${cpfValido}" é VÁLIDO.`);
} else {
    console.log(`CPF "${cpfValido}" é INVÁLIDO.`);
}

// Exemplo 2: CPF Inválido (dígitos errados)
const cpfInvalido = "123.456.789-10";
if (validarCPF(cpfInvalido)) {
    console.log(`CPF "${cpfInvalido}" é VÁLIDO.`);
} else {
    console.log(`CPF "${cpfInvalido}" é INVÁLIDO.`);
}

// Exemplo 3: CPF Inválido (todos os dígitos iguais)
const cpfTodosIguais = "111.111.111-11";
if (validarCPF(cpfTodosIguais)) {
    console.log(`CPF "${cpfTodosIguais}" é VÁLIDO.`);
} else {
    console.log(`CPF "${cpfTodosIguais}" é INVÁLIDO.`);
}

// Exemplo 4: CPF Inválido (menos de 11 dígitos)
const cpfCurto = "123.456-78";
if (validarCPF(cpfCurto)) {
    console.log(`CPF "${cpfCurto}" é VÁLIDO.`);
} else {
    console.log(`CPF "${cpfCurto}" é INVÁLIDO.`);
}
    function verificarCPF() {
        const cpfInput = document.getElementById('cpf');
        const cpfMessage = document.getElementById('cpf-message');
        const cpfValor = cpfInput.value;

        if (validarCPF(cpfValor)) {
            cpfMessage.textContent = 'CPF válido!';
            cpfMessage.style.color = 'green';
        } else {
            cpfMessage.textContent = 'CPF inválido. Por favor, verifique.';
            cpfMessage.style.color = 'red';
        }

        // Limpa a mensagem se o campo estiver vazio
        if (cpfValor.trim() === '') {
            cpfMessage.textContent = '';
        }
    }