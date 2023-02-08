function generateArticle(i, json){
    const postDiv = document.createElement("article");  //<article>
    postDiv.id = "postDiv"+i;
    document.querySelector("#articleContainer").appendChild(postDiv);

    const accountContainerDiv = document.createElement("div"); //<div class = "accountContainer">
    accountContainerDiv.id = "accountContainer"+i;
    accountContainerDiv.className = "accountContainer";
    document.querySelector("#postDiv"+i).appendChild(accountContainerDiv);

    const accountInfoDiv = document.createElement("div"); 
    accountInfoDiv.id = "accountInfo"+i;
    accountInfoDiv.className = "account_info";
    document.querySelector("#accountContainer"+i).appendChild(accountInfoDiv);

    const span_surname = document.createElement("span");  
    span_surname.id = "surname"+i;
    span_surname.className = "acc_surname";
    span_surname.innerHTML = json.author;
    document.querySelector("#accountInfo"+i).appendChild(span_surname);

    const span_agency = document.createElement("span");  
    span_agency.className = "acc_agency";
    span_agency.innerHTML = "("+json.source.name+")";
    document.querySelector("#accountInfo"+i).appendChild(span_agency);

    const creationdate = document.createElement("span");  
    creationdate.id = "datetime"+i;
    creationdate.className = "datetime";
    creationdate.innerHTML = "at " + json.publishedAt.replace("T", " ").slice(0, -4);   //2022-05-17T19:37:34Z original format
    document.querySelector("#accountInfo"+i).appendChild(creationdate);

    
    const deleteContainer = document.createElement("div"); 
    deleteContainer.id = "deleteContainer"+i;
    deleteContainer.className = "delete_container";
    document.querySelector("#accountContainer"+i).appendChild(deleteContainer);

    const shareBtn = document.createElement("button");   
    shareBtn.id = "S"+i;
    shareBtn.className = "sharePostBtn";
    shareBtn.onclick = function(){share(json, i)};
    shareBtn.innerHTML = "Share";
    document.querySelector("#deleteContainer"+i).appendChild(shareBtn);
    

    const post_content = document.createElement("div"); //<div class = "post_content">
    post_content.id = "post_content"+i;
    post_content.className = "post_content";
    document.querySelector("#postDiv"+i).appendChild(post_content);

    const post_text = document.createElement("span");  //span
    post_text.id = "post_text"+i;
    post_text.innerHTML = json.content;
    document.querySelector("#post_content"+i).appendChild(post_text);

    const post_expand = document.createElement("details"); //<div class = "post_content">
    post_expand.id = "post_expand"+i;
    post_expand.className = "";
    document.querySelector("#post_content"+i).appendChild(post_expand);
    
    const post_des = document.createElement("span");  //span
    post_des.id = "post_text"+i;
    post_des.innerHTML = json.description;
    document.querySelector("#post_expand"+i).appendChild(post_des);

    const post_des2 = document.createElement("span");  //span
    post_des2.id = "post_text"+i;
    post_des2.innerHTML = "</br>click to read more:";
    document.querySelector("#post_expand"+i).appendChild(post_des2);

    const link = document.createElement("a");  //span
    link.id = "link"+i;
    link.innerHTML = json.url;
    link.setAttribute('href',json.url);
    link.setAttribute('target','_blank');
    document.querySelector("#post_expand"+i).appendChild(link);

    if(json.urlToImage != null){

    const post_image = document.createElement("div"); //<div class = "post_image">
    post_image.id = "post_image"+i;
    post_image.className = "article_image";
    document.querySelector("#postDiv"+i).appendChild(post_image);

    const img = document.createElement("img");  //img
    img.src = json.urlToImage;
    document.querySelector("#post_image"+i).appendChild(img);

    }
    

   
}

function onJSON(json){

    if(json == 0){
        window.open("/login","_self"); redirrect
    }

    for(let i = 0; i<json.articles.length; i++){
        if(json.articles[i].content != null && json.articles[i].author != null && json.articles[i].author.length < 20)
        generateArticle(i, json.articles[i]);
    }
}

function onResponse(response){
    return response.json();
}

function start(){

    fetch("news/getNews/us") .then(onResponse).then(onJSON);

    country.addEventListener('change', changeVal);


}


function share(json, i){

    let form_data  = new FormData();
    form_data.append('postContent', json.content)
    form_data.append('urlImage', json.urlToImage);

    const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;


    fetch('news/shareNews', {
        method: 'POST',
        headers: {
            //'Content-Type': 'application/json',
            "X-CSRF-Token": csrfToken
        },
        body: form_data,
    });

    document.querySelector("#S"+i).innerHTML = "Shared";
    
}

  

function changeVal(){
    document.querySelector("#articleContainer").innerHTML = "";
   
    fetch("news/getNews/"+country.value) .then(onResponse).then(onJSON);


}