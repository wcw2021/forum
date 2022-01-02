const textEl = document.getElementById('advertise-text')
const text = 'Annoying AD!'
let idx = 1
let speed = 300 / 1

writeText()

function writeText() {
    textEl.innerText = text.slice(0, idx)

    idx++

    if(idx > text.length) {
        idx = 1
    }

    setTimeout(writeText, speed)
}

