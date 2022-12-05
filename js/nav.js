let arrow = document.querySelectorAll(".arrow");
let arrow_sub = document.querySelectorAll(".arrow-sub");

for(var i = 0; i < arrow.length; i++)
{
    arrow[i].addEventListener("click", (e)=>{
        let arrowParent = e.target.parentElement.parentElement;
        arrowParent.classList.toggle("showMenu");
    });
}

for(var i = 0; i < arrow_sub.length; i++)
{
    arrow_sub[i].addEventListener("click", (e)=>{
        let arrowSubParent = e.target.parentElement.parentElement;
        arrowSubParent.classList.toggle("showMenuSub");
    });
}

let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".bx-menu");
console.log(sidebarBtn);

sidebarBtn.addEventListener("click", ()=>{
    sidebar.classList.toggle("close");
});