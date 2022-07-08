
var perfEntries = performance.getEntriesByType("navigation");       //per aggiornare la pagina quando viene premuto il pulsante back del browser

if (perfEntries[0].type === "back_forward") {
    location.reload(true);
}

function onJSON(json){

    document.querySelector("#postsArea").innerHTML = "";
 
    const form = document.forms["newPostForm"];
    form.reset();
    retrievePosts();
 }
 
 function onResponse(response){
    
    return response.json();
     
 }
 
 


    

     function newPost(){
    
     
     const form = document.forms["newPostForm"];

     if(form.postContent.value.length > 0){
 
       
        let form_data  = new FormData();

        const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;


        form_data.append('postContent', form.postContent.value)
        form_data.append('imageSelector', imageSelector.files[0]);

        fetch('home/newPost', {
            method: 'POST',
            headers: {
                //'Content-Type': 'application/json',
                "X-CSRF-Token": csrfToken
            },
            body: form_data,
        }).then(onResponse).then(onJSON);

    }else{
    
     const postContent = document.querySelector("#newPostBar");
     postContent.style.borderColor = "red";
 
    }
     
 
 }
 
 function goHome(){
 
    window.open("home.php","_self");
 
 }
 
 function toProfile(){
    
     let id = document.querySelector("#user_id").innerHTML;
     
     window.open("profile/"+ id,"_self");
 
 }
 
 function displayPost(json, i){
     

    if(json.sharedFrom !== null){

        const sharedContainer= document.createElement("div");  //<div class = "post">
        sharedContainer.id = "sharedContainer"+json.postId;
        sharedContainer.className = "sharedContainer";
        document.querySelector("#postsArea").appendChild(sharedContainer);

        const postSharedFrom = document.createElement("div");
        postSharedFrom.id = "postShared"+json.postId;
        postSharedFrom.className = "sharedDiv";
        document.querySelector("#sharedContainer"+json.postId).appendChild(postSharedFrom);

        const spanshared = document.createElement("span");
        spanshared.innerHTML = "Reposted from "
        document.querySelector("#postShared"+json.postId).appendChild(spanshared);

        const sharedUser = document.createElement("span");
        sharedUser.className = "sharedUser";
        sharedUser.innerHTML = "@"+json.sharedFrom;
        document.querySelector("#postShared"+json.postId).appendChild(sharedUser);
    }

     const postDiv = document.createElement("div");  //<div class = "post">
     postDiv.id = "postDiv"+json.postId;
     postDiv.className = "post";
     document.querySelector("#postsArea").appendChild(postDiv);
 
     const accountContainerDiv = document.createElement("div"); //<div class = "accountContainer">
     accountContainerDiv.id = "accountContainer"+i;
     accountContainerDiv.className = "accountContainer";
     document.querySelector("#postDiv"+json.postId).appendChild(accountContainerDiv);
 
     const accountInfoDiv = document.createElement("div"); 
     accountInfoDiv.id = "accountInfo"+i;
     accountInfoDiv.className = "account_info";
     document.querySelector("#accountContainer"+i).appendChild(accountInfoDiv);
 
     const pro_pic_div = document.createElement("div"); //<div class = "pro_pic">
     pro_pic_div.id = "pro_pic"+i;
 
     if(json.pro_pic == ''){
         pro_pic_div.style.backgroundColor = json.colour;
         pro_pic_div.innerHTML = json.username.substring(0,2);
     }else{
         //set background image
         pro_pic_div.style.backgroundImage = "url(data:image/jpeg;base64,"+json.pro_pic+")";
         pro_pic_div.innerHTML = "";
     }
 
     pro_pic_div.className = "pro_pic";
     document.querySelector("#accountInfo"+i).appendChild(pro_pic_div);
 
     const span_surname = document.createElement("span");  //<span class = "acc_surname">@Francesco</span>
     span_surname.id = "surname"+i;
     span_surname.className = "acc_surname";
     span_surname.innerHTML = "@"+json.username;
     document.querySelector("#accountInfo"+i).appendChild(span_surname);
 
     const creationdate = document.createElement("span");  //<span class = "datetime">at 01:34 13/05/2022</span>
     creationdate.id = "datetime"+i;
     creationdate.className = "datetime";
     creationdate.innerHTML = "at " + json.creationdate.slice(0,-3);
     document.querySelector("#accountInfo"+i).appendChild(creationdate);
 
     if(json.owner == true){
     const deleteContainer = document.createElement("div"); 
     deleteContainer.id = "deleteContainer"+i;
     deleteContainer.className = "delete_container";
     document.querySelector("#accountContainer"+i).appendChild(deleteContainer);
 
     const deleteBtn = document.createElement("button");   
     deleteBtn.id = "D"+json.postId;
     deleteBtn.className = "deletePostBtn";
     deleteBtn.onclick = function(){onDeletePost(this.id)};
     document.querySelector("#deleteContainer"+i).appendChild(deleteBtn);

     const iTagD = document.createElement("i");
     iTagD.className = "material-icons";
     iTagD.id = "iTagD"+json.postId;
     iTagD.style.cssText = "font-size: 19px; width: 20px; height:20px";
     iTagD.innerHTML = "delete_forever";
     document.querySelector("#D"+json.postId).appendChild(iTagD);

     }
 
     const post_content = document.createElement("div"); //<div class = "post_content">
     post_content.id = "post_content"+i;
     post_content.className = "post_content";
     document.querySelector("#postDiv"+json.postId).appendChild(post_content);
 
     const post_text = document.createElement("span");  //span
     post_text.id = "post_text"+i;
     post_text.innerHTML = json.content;
     document.querySelector("#post_content"+i).appendChild(post_text);
 
     
     if(json.image != ""){
 
     const post_image = document.createElement("div"); //<div class = "post_image">
     post_image.id = "post_image"+i;
     post_image.className = "post_image";
     document.querySelector("#postDiv"+json.postId).appendChild(post_image);
 
     const img = document.createElement("img");  //img
     img.src = "data:image/jpeg;base64,"+json.image;
     document.querySelector("#post_image"+i).appendChild(img);
 
     }
 
     
     if(json.urlNewsImage !== null){
 
     const post_image = document.createElement("div"); //<div class = "post_image">
     post_image.id = "post_image"+i;
     post_image.className = "post_image";
     document.querySelector("#postDiv"+json.postId).appendChild(post_image);
 
     const img = document.createElement("img");  //img
     img.src = json.urlNewsImage;
     document.querySelector("#post_image"+i).appendChild(img);
 
     }
     
     const interactive_bar = document.createElement("div"); //<div class = "interactive_bar">
     interactive_bar.id = "interactive_bar"+i;
     interactive_bar.className = "interactive_bar";
     document.querySelector("#postDiv"+json.postId).appendChild(interactive_bar);
 
 
     //LIKE BUTTON
 
     if(json.liked != null){   //liked
 
     const likeBtn = document.createElement("button");   //<button class = "commentBtn"><i class="material-icons" style="font-size: 20px; margin-top:4px; margin-left:-1px; color:darkslategrey">comment</i></button>
     likeBtn.id = "L"+json.postId;
     likeBtn.className = "likeBtn";
     likeBtn.onclick = function(){onLike(this.id)};
     likeBtn.classList.add("likeBtnClicked");
     document.querySelector("#interactive_bar"+i).appendChild(likeBtn);
 
     const iTag = document.createElement("i");
     iTag.className = "material-icons";
     iTag.id = "iTag"+json.postId;
     iTag.style.cssText = "font-size: 20px; margin-top:4px; margin-left:-1px; color:red";
     iTag.innerHTML = "favorite_border";
     document.querySelector("#L"+json.postId).appendChild(iTag);
 
     }else{  //not liked
 
         const likeBtn = document.createElement("button");   //<button class = "commentBtn"><i class="material-icons" style="font-size: 20px; margin-top:4px; margin-left:-1px; color:darkslategrey">comment</i></button>
         likeBtn.id = "L"+json.postId;
         likeBtn.className = "likeBtn";
         likeBtn.onclick = function(){onLike(this.id)};
         document.querySelector("#interactive_bar"+i).appendChild(likeBtn);
     
         const iTag = document.createElement("i");
         iTag.className = "material-icons";
         iTag.id = "iTag"+json.postId;
         iTag.style.cssText = "font-size: 20px; margin-top:4px; margin-left:-1px; color:darkslategrey";
         iTag.innerHTML = "favorite_border";
         document.querySelector("#L"+json.postId).appendChild(iTag);
     }
 
 
     const num_likes = document.createElement("span");
     num_likes.id = "number_likes"+json.postId;
     num_likes.className = "number";
     num_likes.innerHTML = json.num_likes;
     document.querySelector("#interactive_bar"+i).appendChild(num_likes);
 
     //COMMENT BUTTON
 
     const commentBtn = document.createElement("button");   //<button class = "commentBtn"><i class="material-icons" style="font-size: 20px; margin-top:4px; margin-left:-1px; color:darkslategrey">comment</i></button>
     commentBtn.id = "C"+json.postId;
     commentBtn.className = "commentBtn";
     commentBtn.onclick = function(){showComments(this.id)};
     document.querySelector("#interactive_bar"+i).appendChild(commentBtn);

     const iTagC = document.createElement("i");
     iTagC.className = "material-icons";
     iTagC.style.cssText = "font-size: 20px; margin-top:4px; margin-left:-1px; color:darkslategrey";
     iTagC.innerHTML = "comment";
     document.querySelector("#C"+json.postId).appendChild(iTagC);
 
     const num_comments = document.createElement("span");
     num_comments.id = "number_comments"+json.postId;
     num_comments.className = "number";
     num_comments.innerHTML = json.num_comments;
     document.querySelector("#interactive_bar"+i).appendChild(num_comments);
 

     if(json.owner == false){
     const shareBtn = document.createElement("button");   //<button class = "commentBtn"><i class="material-icons" style="font-size: 20px; margin-top:4px; margin-left:-1px; color:darkslategrey">comment</i></button>
     shareBtn.id = "S"+json.postId;
     shareBtn.className = "commentBtn";
     shareBtn.onclick = function(){sharePost(json.image, json.urlNewsImage, json.content, json.username)};
     document.querySelector("#interactive_bar"+i).appendChild(shareBtn);

     const iTagS = document.createElement("i");
     iTagS.className = "material-icons";
     iTagS.style.cssText = "font-size: 20px; margin-top:4px; margin-left:-1px; color:darkslategrey";
     iTagS.innerHTML = "share";
     document.querySelector("#S"+json.postId).appendChild(iTagS);
     }
     const comment_bar = document.createElement("div");
     comment_bar.id = "comment_bar"+json.postId;
     comment_bar.className = "comment_bar";
     document.querySelector("#postDiv"+json.postId).appendChild(comment_bar);
 
 }
 
 function sharePost(image, url, content, username){


    let form_data  = new FormData();

        const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
        if(url === undefined)   url = '';

        form_data.append('postContent', content)
        form_data.append('image', image);
        form_data.append('url', url);
        form_data.append('user', username);

        fetch('home/sharePost', {
            method: 'POST',
            headers: {
                "X-CSRF-Token": csrfToken
            },
            body: form_data,
        }).then(onResponse).then(onJSON);
        
 }

 function onJSONposts(json){
     

    if(json === 0){
        window.open("login","_self"); redirrect
    }

    if(json.length === undefined){
        document.getElementById("noPosts").style.display = "block";
    }else{

    document.querySelector("#postsArea").innerHTML = "";

     for(let i = 0; i<json.length; i++){
         displayPost(json[i], i);
     }

    }
 
 }
 
 function onJSONlikes(json){
     let numberLikes = document.querySelector("#number_likes"+json.postId);
     numberLikes.innerHTML = json.number;
 
     const iTag = document.querySelector('#iTag'+json.postId);
     const likeBtn = document.querySelector("#L"+json.postId);
 
     if(json.action == 'like'){
         iTag.style.color = "red";
         likeBtn.classList.add("likeBtnClicked");
     }else{
         iTag.style.color = "rgb(47, 79, 79)";
         likeBtn.classList.remove("likeBtnClicked");
     }
 
 }
 
 function onLike(buttonId){
 
     let postId = buttonId.substring(1);
 
     fetch("home/like/"+encodeURIComponent(postId)).then(onResponse).then(onJSONlikes);;

 }
 
 

 function start(){
     retrievePosts();
     searchFriend();
 }
 
 function retrievePosts(){
 
    
     fetch("home/getPosts/"+encodeURIComponent(-1)).then(onResponse).then(onJSONposts);


 }
 
 
 
 function onDeletePost(buttonId){
 
     let postId = buttonId.substring(1);

     fetch("home/deletePost/"+encodeURIComponent(postId)).then(retrievePosts);;

 }
 
 function generateCommentSection(postId){
 
     const comment_form = document.createElement("form");
     comment_form.id = "comment_form"+postId;
     comment_form.className = "newCommentForm";
     comment_form.name = "newPostForm";
     //comment_form.enctype = "multipart/form-data";
     comment_form.action = "";
     comment_form.method = "post";
     document.querySelector("#comment_bar"+postId).appendChild(comment_form);
 
     const textArea = document.createElement("input");
     textArea.className = "commentTextField";
     textArea.name = "commentContent";
     textArea.id = "commentContent"+postId;
     textArea.cols = "50";
     textArea.rows = "1";
     textArea.placeholder = "Write something here...";
     textArea.onfocus = "this.placeholder = ''";
     textArea.onblur = "this.placeholder = 'Write something here...'";
     document.querySelector("#comment_form"+postId).appendChild(textArea);
 
     const sendCommBtn = document.createElement("button");
     sendCommBtn.className = "sendComment",
     sendCommBtn.id = "SC"+postId;
     sendCommBtn.name = "submit";
     sendCommBtn.onclick = function(){newComment(this.id); return false;};;
     sendCommBtn.innerHTML = "Comment";
     document.querySelector("#comment_form"+postId).appendChild(sendCommBtn);
 
 }
 
 function generateComment(postId, i, username, datetime, comment){
 
     const comments = document.createElement("div");
     comments.className = "comment";
     comments.id = "comment"+ postId+i;
     document.querySelector("#comment_bar"+postId).appendChild(comments);
 
     const commentCreator = document.createElement("div");
     commentCreator.className = "comment_creator";
     commentCreator.id = "comment_creator"+postId+i;
     document.querySelector("#comment"+postId+i).appendChild(commentCreator);
 
     const acc_surname = document.createElement("span");
     acc_surname.className = "acc_surname";
     acc_surname.id = "acc_surname"+postId+i;
     acc_surname.innerHTML = "@"+username;
     document.querySelector("#comment_creator"+postId+i).appendChild(acc_surname);
 
     const date = document.createElement("span");
     date.className = "datetime";
     date.id = "datetime"+postId+i;
     date.innerHTML = "at "+datetime;
     document.querySelector("#comment_creator"+postId+i).appendChild(date);
 
     const commentContent = document.createElement("div");
     commentContent.className = "comment_content";
     commentContent.id = "comment_content"+postId+i;
     document.querySelector("#comment"+postId+i).appendChild(commentContent);
 
     const content = document.createElement("span");
     content.innerHTML = comment;
     document.querySelector("#comment_content"+postId+i).appendChild(content);
 
 }
 
 function showComments(commentBtnId){
 
     let postId = commentBtnId.substring(1);
     const commentbar = document.querySelector("#comment_bar"+postId);
     
     if(commentbar.innerHTML == ''){
 
     generateCommentSection(postId);
     getComments(postId);
 
     }else{
 
     commentbar.innerHTML = '';
 
     }
     
     
 }
 
 function onJSONcomments(json){
         
     const num_comments = document.querySelector("#number_comments"+json.postId);
     num_comments.innerHTML = json.number_comments;
 
     document.querySelector("#comment_bar"+json.postId).innerHTML = '';
     generateCommentSection(json.postId);
     getComments(json.postId);
     
 }
 
 function onJSONGetcomments(json){


     for(let i = 0; i<json.length; i++){
         generateComment(json[i].id_post, i, json[i].Username, json[i].creationdateComment, json[i].content);
     }
     
 }
 
 function getComments(postId){
    
     fetch("home/getComments/"+postId).then(onResponse).then(onJSONGetcomments);


 }
 
 
 
 function newComment(buttonId){
     
     let postId = buttonId.substring(2);
     const form = document.forms["comment_form"+postId];
     const commentBox = document.querySelector("#commentContent"+postId);
 
     if(form.commentContent.value.length == 0){
         commentBox.style.borderColor = "red";
     }else{
 
     commentBox.style.borderColor = "#ccc";

     fetch("home/newComment/"+encodeURIComponent(postId)+"/"+encodeURIComponent(form.commentContent.value)).then(onResponse).then(onJSONcomments);


     }
 
     form.reset();
 
 
 }
 
 function generateRecommendedFriend(i, json){
 
     const article = document.createElement("article");
     article.id = "article"+i;
     document.querySelector("#newFriendsBackground").appendChild(article);
 
     const div = document.createElement("div");
     div.className = "imagePic";
     div.id = "div"+i;
     if(json.proPic == ""){
     div.innerHTML = json.username.substring(0,2);
     div.style.backgroundColor = json.colour;
     }else{
         //set image background
         div.style.backgroundImage = "url(data:image/jpeg;base64,"+json.proPic+")";
     }
     document.querySelector("#article"+i).appendChild(div);
 
     const namebtn = document.createElement("button");
     namebtn.className = "recommended_friend";
     namebtn.innerHTML = "@"+json.username;
     namebtn.id = "U"+json.id;   //the button has the user's id, to redirect to his page.
     namebtn.onclick = function(){window.open("profile/"+ json.id,"_self");};
     document.querySelector("#article"+i).appendChild(namebtn);
 
     const followbtn = document.createElement("button");
     followbtn.className = "add_recommended_friend";
     if(json.followed){
        followbtn.innerHTML = "Unfollow";
     }else{
        followbtn.innerHTML = "Follow";
     }
     followbtn.id = "A"+json.id;   //the button has the user's id, to redirect to his page.
     followbtn.onclick = function(){followBtnClick(json.id)};
     document.querySelector("#article"+i).appendChild(followbtn);
 
 }
 
 function onJSONfollow(json){

  
    
    let followButton = document.querySelector("#A"+json[0].friend_id);

    
    if(json[0].action == 'follow'){

        followButton.innerHTML = 'Unfollow';

    }else{

        followButton.innerHTML = 'Follow';


    }
    
    
 }

 function followBtnClick(FriendId){
     fetch("home/follow/"+FriendId).then(onResponse).then(onJSONfollow);
 }
 
 function goToEvents(){
 
     window.open("news","_self");
 
 
 
 }
 
 function onJSONsearch(json){

     document.querySelector("#newFriendsBackground").innerHTML = "";
    
     if(json.error !== 'undefined');
     for(let i = 0; i<json.length; i++){
         generateRecommendedFriend(i, json[i]);
     }
     
 
 }
 
 function searchFriend(){
     const formsearch = document.forms['search'];
 
     let text = formsearch.searchValue.value;
     if(text == "")  text = "-1";

     fetch("home/searchFriend/"+text).then(onResponse).then(onJSONsearch);


 }
 