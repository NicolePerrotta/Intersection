//Registrazione
function validaRegistrazione()
{   
    var b=true;
    if(document.formRegistrazione.emailR.value!=document.formRegistrazione.emailR2.value)
    {
        $("#erroreEmail").show();
        location.href = "#emailR";
        b=false;
    }
    else
    {
        $("#erroreEmail").hide();
    }
    if(document.formRegistrazione.passwordR.value!=document.formRegistrazione.passwordR2.value)
    {
        $("#errorePassword").show();
        if(b==true) location.href = "#passwordR";
        b=false;
    }
    else
    {
        $("#errorePassword").hide();
    }
    const datanascita = document.formRegistrazione.dataDiNascita.value;
    const years = calcAge(datanascita);
    if(years<18)
    {
        $("#erroreEta").show();
        if(b==true) location.href = "#dataDiNascita";
        b=false;
    }
    else
    {
        $("#erroreEta").hide();
    }
    if(years>150)
    {
        $("#erroreEta2").show();
        if(b==true) location.href = "#dataDiNascita";
        b=false;
    }
    else
    {
        $("#erroreEta2").hide();
    }
    return b;
}

function calcAge (birthday)
{
    var today = new Date();
    var birthDate = new Date(birthday);
    var years = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate()))
    {
        years--;
    }
    return years;
}

//Registrazione Aziendale
function validaRegistrazioneAziendale()
{
    var b=true;
    if(document.formRegistrazioneAziendale.emailRA.value!=document.formRegistrazioneAziendale.emailRA2.value)
    {
        $("#erroreEmail").show();
        location.href = "#emailRA";
        b=false;
    }
    else
    {
        $("#erroreEmail").hide();
    }
    if(document.formRegistrazioneAziendale.passwordRA.value!=document.formRegistrazioneAziendale.passwordRA2.value)
    {
        $("#errorePassword").show();
        if(b==true) location.href = "#passwordRA";
        b=false;
    }
    else
    {
        $("#errorePassword").hide();
    }
    return b;
}