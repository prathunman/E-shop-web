



function insertValue()
{
    var xhr= new XMLHttpRequest();
    xhr.open('GET','https://dummyjson.com/products',true);

    xhr.onload=function(){
        if(this.status==200){
            var user=JSON.parse(this.responseText);
            output='';
            var products=user.products;
            var i=0;
            for(u in products){
                if(i<10){
                    console.log(products[u].title)
                    $.ajax({
                        url:"insert.php",
                        method:"post",
                        data:{
                            ID:products[u].id,
                            Title:products[u].title,
                            Description:products[u].description,
                            Price:products[u].price,
                            Thumbnail:products[u].thumbnail
                        },
                        success:function(data)
                        {
                            console.log(data)
                        }              
                    })  
                    i++;             
                }          
            }   
            
        }
    }
    xhr.send();

}

