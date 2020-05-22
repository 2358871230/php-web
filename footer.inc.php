</div>
        </div>
        <div id="footer"></div>
    </div>
    <script type="text/javascript">
        var data = [{id:1,name:"中国",children:[
            {id:3,name:"重庆",children:[
                {id:5,name:"奉节"},
                {id:6,name:"江北"}
            ]
                
            },
            {id:4,name:"广东"}
        ]},
        {id:2,name:"美国"}
        ];
        function makeTree(container,data){
            for(var i=0,j=data.length;i<j;i++)(function(treeNodeData){
                var li = document.createElement("li");
                li.className="collapse";
                var nameSpan = document.createElement("span");
                nameSpan.innerText = treeNodeData.name;
                li.appendChild(nameSpan);
                container.appendChild(li);
                if(treeNodeData.children){
                    var ul=document.createElement("ul");
                    ul.style.display="none";
                    li.appendChild(ul);
                    makeTree(ul,treeNodeData.children);
                    nameSpan.onclick = function(){
                        if(ul.style.display==="none"){
                            ul.style.display="block";
                            li.className = "expand";
                        } 
                        else{
                            ul.style.display = "none";
                            li.className = "collapse";
                        } 
                    }
                }
            })(data[i]);
        };
        makeTree(document.getElementById("tree"),data);
    </script>
    <script type="text/javascript">
       
        
        var mainMenu=document.getElementById("main-menu");
        var lis = mainMenu.getElementsByTagName("li");

        for(var i=0,j=lis.length;i<j;i++){
            var li=lis[i];
            li.onmouseenter = function(){
                //console.log(li.id,"onmouseenter start");
                var enteredLi = this;
                var ul = enteredLi.children[1];
                if(!ul) return;
                //console.log(li.id,"ul found");
                ul.style.opacity = 0.5;
                var tick = setInterval(function(){
                    var opacity = parseFloat(ul.style.opacity);
                    opacity += 0.1;
                    if(opacity>=1){
                        clearInterval(tick);
                        ul.style.opacity = 1;
                        //console.log(li.id,"clearInterval");
                    }else {
                        ul.style.opacity = opacity;
                    }
                }
                ,100);
            }
           
        }
    </script>
</body>
</html>