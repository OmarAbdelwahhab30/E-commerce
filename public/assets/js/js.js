var products ;
let carts = document.querySelectorAll('.carts')

for (let i = 0 ; i <= carts.length;i++)
{
    if (carts[i]){
        carts[i].addEventListener('click',()=>{
            CartCounter()
        })
    }
}
function CartCounter() {

    let cartnum = localStorage.getItem("cartnum");
    if (cartnum){
        products = parseInt(localStorage.getItem("cartnum"));
        localStorage.setItem("cartnum",products+1);
    }else {
        localStorage.setItem("cartnum",1);
    }
    document.getElementById("products").textContent = localStorage.getItem("cartnum");
}

function EmptyTheBasket(){
    document.getElementById("products").textContent = localStorage.getItem("cartnum");
    localStorage.clear();
}
