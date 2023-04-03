var inputField = document.querySelector('[name="link"]')
var userInputField = document.querySelector('[name="userCustomLink"]')
var box = document.querySelector(".box")
var loading = document.querySelector(".loading")
var result = document.querySelector(".result")
var linkRes = document.querySelector(".link-result")
var customBox = document.querySelector(".box-custom")
var toogle = document.querySelector(".toogle")
var navBar = document.querySelector(".nav-bar")
var root = document.querySelector(':root');

root.style.setProperty("--display-mobile", "none");
userInputField.addEventListener('input', adjustWidth)

function aboutUs() {
    Swal.fire({
        title: 'Tentang Kami',
        icon: 'question',
        html: '<b>Pendek.in</b> adalah sebuah website yang dapat kamu gunakan untuk mengubah URL menjadi pendek dan singkat.',
        showConfirmButton: false,
    }
    )
}

function contactUs() {
    Swal.fire({
        title: 'Kontak Kami',
        icon: 'info',
        html: '<i class="fa fa-envelope"></i> contact@mail.com',
        showConfirmButton: false,
    }
    )
}

function termOfUse() {
    Swal.fire({
        title: 'Term of use',
        icon: 'warning',
        html: 'Link pendek yang telah anda buat dapat diakses selama 2 (dua) hari setelah dibuat.',
        showConfirmButton: false,
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

    if (!isValidUrl(inputField.value)) {
        box.classList.add("error")
        inputField.value = ""
        Swal.fire({
            position: 'top-end',
            html: 'Link yang Anda masukkan tidak valid',
            showConfirmButton: false,
            timer: 1400,
            background: '#fce4e4'
        })
    }
    if (isValidUrl(inputField.value)) {
        box.classList.remove("error")
        inputField.setAttribute('readonly', true)
        result.classList.add("hidden")

        fetch("http://localhost/link/pendek-in/php/generateLink.php", {
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
                if (response.includes("Error:")) {
                    loading.classList.add("hidden")
                    userInputField.value = ""
                    Swal.fire({
                        position: 'top-end',
                        html: response,
                        showConfirmButton: false,
                        timer: 1400,
                        background: '#fce4e4'
                    })
                } if (!response.includes("Error:")) {
                    loading.classList.remove("hidden")
                    setTimeout(function () {
                        inputField.value = ""
                        userInputField.value = ""
                        inputField.removeAttribute('readonly')
                        loading.classList.add("hidden")
                        result.classList.remove("hidden")

                        width = (response.length * 8) + 25
                        root.style.setProperty('--width-result', width + "px")
                        root.style.setProperty('--badge-position', -(width / 1.5) + "px")
                        linkRes.value = response
                    }, 650)
                }
            })
            .catch(err => console.log(err))
    }
}

function removeSpace() {
    userInputField.value = userInputField.value.replace(/\s+/g, '-')
}

function adjustWidth() {
    var width = userInputField.value.length * 8 + 25; // 8px per character
    userInputField.style.width = width + "px";
}

function copyLink() {
    linkRes.select();
    linkRes.setSelectionRange(0, 99999); // For mobile devices

    navigator.clipboard.writeText(linkRes.value);
}

function createCustomLink() {
    customBox.classList.toggle("show")
    userInputField.setAttribute('autofocus', true)
    setTimeout(function () { userInputField.value = "" }, 250)
}

toogle.addEventListener("click", function () {
    var display = getComputedStyle(root).getPropertyValue("--display-mobile")
    if (display == "none") {
        root.style.setProperty("--display-mobile", "inline");
    } else {
        root.style.setProperty("--display-mobile", "none");
    }
})