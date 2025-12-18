/* 馬なでなでインタラクション */ 
document.querySelectorAll('.horse-img').forEach(img => {
    // なで始め（指が触れた時）
    img.addEventListener('pointerdown', (e) => {
        e.preventDefault(); // 画面スクロール防止（タッチ時）
    
        img.classList.add('shake');
    
        const audio = document.getElementById('crySound');
        audio.currentTime = 0;
        audio.play();
        
        const x = e.pageX;
        const y = e.pageY;
        const effect = document.createElement('div');
        effect.classList.add('effect');
        effect.style.left = (x - 10) + 'px';
        effect.style.top = (y - 10) + 'px';

        const effects = ['heart', 'star', 'flower', 'music'];
        const selected = effects[Math.floor(Math.random() * effects.length)];
        if (selected === 'heart') {        
            const hearts = [
                { dx: -20, dy:  10 },  // 左
                { dx:  20, dy:   0 },  // 右
                { dx:   0, dy: -25 }   // 中央
            ];
            hearts.forEach(pos => {
                const h = document.createElement('div');
                h.classList.add('heart');
                h.textContent = '❤️';
                h.style.left = pos.dx + 'px';
                h.style.top = pos.dy + 'px';
                effect.appendChild(h);
            });
        }else{
            const imgEffect = document.createElement('img');
            if (selected === 'star')       imgEffect.src = 'img/star.png';
            if (selected === 'flower')     imgEffect.src = 'img/flower.png';
            if (selected === 'music')      imgEffect.src = 'img/music_note.png';
            effect.appendChild(imgEffect);            
        }
        document.body.appendChild(effect);
        setTimeout(() => {
            img.classList.remove('shake');
            effect.remove();
        }, 1000);
    });

    // なで終わり（指が離れた時）
    img.addEventListener('pointerup', () => {
        img.classList.remove('shake');
    });
});
// なでた馬を最前面表示
let maxZ = 10;
document.querySelectorAll('.horse').forEach(horse => {
    horse.addEventListener('pointerdown', () => {
        maxZ++;
        horse.style.zIndex = maxZ;
    });
});


function ChangeToMita() {
    document.body.style.backgroundImage = "url('img/mita.png')";
}
function ChangeToHiyoshi() {
    document.body.style.backgroundImage = "url('img/hiyoshi.png')";
}
function ChangeToYagami() {
    document.body.style.backgroundImage = "url('img/yagami.png')";
}
function ChangeToShinano() {
    document.body.style.backgroundImage = "url('img/shinano.png')";
}
function ChangeToSfc() {
    document.body.style.backgroundImage = "url('img/sfc.png')";
}