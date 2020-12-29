var btn = document.querySelectorAll('.suppr')

console.info('App.js is loaded')

btn.forEach(k => {
    k.addEventListener('submit', (e)=>{
        e.preventDefault()
        if(confirm("Suppression de ")) {
            const data = new FormData(k)
            const xhr  = new XMLHttpRequest()
            xhr.open(k.getAttribute('method'),k.getAttribute('action'), true)
            xhr.send(data)
            
            setInterval(()=>{document.location.href = "/"},1000)
        }
    })
})


var img = document.querySelectorAll('img')

img.forEach(k => {
    k.addEventListener('dragstart',(e) => {
        e.preventDefault()
        return false
    })
    k.addEventListener('mousemove',(e) => {
        e.preventDefault()
        return false
    })
    k.addEventListener('mousedown',(e) => {
        e.preventDefault()
        return false
    })

    k.addEventListener('contextmenu', (e) => {
        e.preventDefault()
        console.log("contextmenu")
    })
})