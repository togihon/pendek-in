function aboutUs() {
    Swal.fire({
        title: 'Tentang Kami',
        icon: 'question',
        html: '<b>Pendek.in</b> adalah sebuah website yang dapat kamu gunakan untuk mengubah URL menjadi pendek dan singkat.',
        confirmButtonText: 'Good to know',
        confirmButtonColor: '#3085d6',
    }
    )
}

function isValidUrl(string) {
    try {
        const newUrl = new URL(string);
        return newUrl.protocol === 'http:' || newUrl.protocol === 'https:';
    } catch (err) {
        return false;
    }
}

function createLink() {
    var inputField = document.querySelector('[name="link"]')
    var userInputField = document.querySelector('[name="userCustomLink"]')
    var box = document.querySelector(".box")
    var loading = document.querySelector(".loading")
    var result = document.querySelector(".result")
    var linkRes = document.querySelector(".link-result")
    var customBox = document.querySelector(".box-custom")
    var root = document.querySelector(':root');

    if (!isValidUrl(inputField.value)) {
        box.classList.add("error")
        inputField.value = ""
    }
    if (isValidUrl(inputField.value)) {
        box.classList.remove("error")
        loading.classList.remove("hidden")
        inputField.setAttribute('readonly', true)
        result.classList.add("hidden")

        fetch("http://localhost/shortlink/php/generateLink.php", {
            method: "POST",
            body: JSON.stringify({
                link: inputField.value,
                custom: userInputField.value
            }),
            headers: {
                "Content-Type": "application/json; charset=UTF-8"
            }
        }).then(response => response.text())
            .then((response) => {
                //if response == "link tidak bisa digunakan" ....
                setTimeout(function () {
                    inputField.value = ""
                    userInputField.value = ""
                    inputField.removeAttribute('readonly')
                    loading.classList.add("hidden")
                    result.classList.remove("hidden")

                    width = (response.length * 10) + 10
                    root.style.setProperty('--width-result', width + "px")
                    root.style.setProperty('--badge-position', -(width/1.5) + "px")
                    linkRes.value = response
                }, 650)

            })
            .catch(err => console.log(err))
    }
}


function copyLink() {
    var linkRes = document.querySelector(".link-result")

    linkRes.select();
    linkRes.setSelectionRange(0, 99999); // For mobile devices

    navigator.clipboard.writeText(linkRes.value);
}

function createCustomLink() {
    document.querySelector(".box-custom").classList.toggle("show")
    setTimeout(function () { document.querySelector('[name="userCustomLink"]').value = "" }, 250)
}
