var btn = document.querySelectorAll('.suppr')

btn.forEach(k => {
    console.log(k)
    k.addEventListener('submit', (e)=>{
        e.preventDefault()
        confirm("Cancel?")

        const data = new FormData(k)
        const xhr  = new XMLHttpRequest()
        xhr.open(k.getAttribute('method'),k.getAttribute('action'), true)
        xhr.send(data)
        
        setInterval(()=>{document.location.href = "/"},1000)

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