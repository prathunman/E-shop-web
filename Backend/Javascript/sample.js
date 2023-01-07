var cart=[];

function addvalue(item)
{
    if(!cart.includes(item.id))
    {
        console.log(item);
        cart.push(item.id);
        var cartList=document.getElementById('cartItems');
        let itemList=`
        <li id="list-item-${item.id}">
            <div class="container mx-4 my-4">
                <div class="w-64 border">
                <div class="p-4">
                    <h5 class="text-sm text-gray-500 font-bold tracking-widest mb-2 uppercase">${item.name}</h5>
                    <p>$${item.price}</p>
                    <button href="#" onclick="removeCartItem(${item.id})" class="bg-red-500 hover:bg-red-400 text-white px-4 py-2 inline-block mt-4 rounded"><i class="fa-solid fa-circle-xmark"></i></button>
                </div>
                </div>
            </div>
        </li>`;
        cartList.innerHTML+=itemList;
    }
}

function removeCartItem(itemId) {
    const cartItems = document.getElementById("cartItems");
    let i = document.getElementById("list-item-" + itemId);
    cartItems.removeChild(i);
    delete cart[cart.indexOf(itemId)];
}

var cart=[];

function productLoad(){
    var xhr= new XMLHttpRequest();
    xhr.open('GET','https://dummyjson.com/products',true);

    xhr.onload=function(){
        if(this.status==200){
            var user=JSON.parse(this.responseText);
            output='';
            var products=user.products;
            var i=0;
            for(u in products){
                if(i<5){
                    output +=`<div class="column">
                    <div class="card">
                    <img src="${products[u].thumbnail}" alt="${products[u].name}" style="width:60%; height: 60%;">
                    <h3 class="pname">${products[u].title}</h3>
                    <h5 class="pdescription">${products[u].description}</h5>
                    <p><button class="btn" onclick="addToCart({'id':${products[u].id},'name':'${products[u].title}','Description':'${products[u].description}','Thumbnail':'${products[u].thumbnail}'})">Add to Cart</button></p>
                    </div>
                    </div>`
                i++;
                }          
            }   
            $('#row').html(output);
            
        }
    }
    xhr.send();
}

productLoad();


// // function addToCart(item) {
// //     if (!cart.includes(item.id)) {
// //       cart.push(item.id);
// //       $.ajax({
// //         url:"insert.php",
// //         method:"post",
// //         data:{
// //             ID:item.id,
// //             Title:item.name,
// //             Description:item.Description,
// //             Thumbnail:item.Thumbnail
// //         },
// //         success:function(data)
// //         {
// //             console.log(item.description)
// //         }

// //       })
// //     }
// //   }

// function removeCartItem(itemId){
//     const cartItems=document.getElementById("cartItems");
//     let i=document.getElementById("list-item-"+itemId);
//     cartItems.removeChild(i);
//     delete cart[cart.indexOf(itemId)];
// }



