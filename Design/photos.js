/* Javascipt file to implement the Mustache framework */
$(document).ready(function getPhotos(){
    var template = $("#template").html();
    /* Parse the template script block in the main html file */
    Mustache.parse(template);
    /* render the following contents into the template section */
    var rendered = Mustache.render(template, {
        /* define the image paths of the images to be inserted into the first column as well as variables for title and category*/
        col1: 
            [{
                name: "images\\1.jpg",
                url: "detailed.html?image=images\\1.jpg&title=Tent&category=Outdoor/Camping",
                urlBuy: "detailedBuy.html?image=images\\1.jpg&title=Tent&category=Outdoor/Camping",
            },
            {
                name: "images\\2.jpg",
                url: "detailed.html?image=images\\2.jpg&title=Towels&category=Home/Bath",
                urlBuy: "detailedBuy.html?image=images\\2.jpg&title=Towels&category=Home/Bath",
            },
        ],

        /* define the image paths of the images to be inserted into the second column as well as variables for title and category*/
        col2: 
            [{
                name: "images\\3.jpg",
                url: "detailed.html?image=images\\3.jpg&title=Headphones&category=Electronics",
                urlBuy: "detailedBuy.html?image=images\\3.jpg&title=Headphones&category=Electronics",
            },
            {
                name: "images\\4.jpg",
                url: "detailed.html?image=images\\4.jpg&title=T-Shirts&category=Clothing",
                urlBuy: "detailedBuy.html?image=images\\4.jpg&title=T-Shirts&category=Clothing",
            },
        ],

        /* define the image paths of the images to be inserted into the third column as well as variables for title and category*/
        col3: 
            [{
                name: "images\\5.jpg",
                url: "detailed.html?image=images\\5.jpg&title=DSLR&category=Electronics",
                urlBuy: "detailedBuy.html?image=images\\5.jpg&title=DSLR&category=Electronics",
            },
            {
                name: "images\\6.jpg",
                url: "detailed.html?image=images\\6.jpg&title=Chair&category=Furniture",
                urlBuy: "detailedBuy.html?image=images\\6.jpg&title=Chair&category=Furniture",
            },
        ],
        
    })
    /* render the contents into the target div id */
    return $("#target").html(rendered);
});


/* function to retrieve a given query variable from the URL. */
function getQueryVariable(variable)
{
    /* Set the query variable to be the current page URL query string using window.location.search*/
    var query = window.location.search.substring(1);
    /* Split the query string at the & character to divide up all the variables */
    var vars = query.split("&");

    /* For each variable, split the string at the = character to get the variable value. Check to see if 
    the pair variable containing the variable name at the beginning is equal to the variable input parameter, if so return it's value */
    for (var i=0;i<vars.length;i++) {
            var pair = vars[i].split("=");
            if(pair[0] == variable){return pair[1];}
    }

    /* If no match found, return false */
    return(false);
}

/* function to notify the user an image has been posted successfully. Redirect user to home page afterwards */
function posted(){
    alert("Posted successfully!")
    window.location.replace("index.html");
}

/* function to notify the user that login was successful. Redirect user to home page afterwards */
function login(){
    alert("Logged in successfully!")
    window.location.replace("index.html");
}

/* function to notify the user that the new account was created successfully. Redirect user to login page afterwards */
function newaccount(){
    alert("New Account created successfully! Please login")
    window.location.replace("login.html");
}

/* function to notify the user that the message on the contact form was sent successfully. */
function contactsend(){
    alert("Your message has been successfully sent!")
    
}
  