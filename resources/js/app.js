require('./bootstrap');
import EditorJS from '@editorjs/editorjs';
const Embed = require('@editorjs/embed');
const AttachesTool = require('@editorjs/attaches');
const RawTool = require('@editorjs/raw');
const SimpleImage = require('@editorjs/simple-image');
const Checklist = require('@editorjs/checklist');
const CodeTool = require('@editorjs/code');
const Personality = require('@editorjs/personality');
const Quote = require('@editorjs/quote');
const Warning = require('@editorjs/warning');
const Marker = require('@editorjs/marker');
const List = require('@editorjs/list');
const InlineCode = require('@editorjs/inline-code');
const LinkTool = require('@editorjs/link');
const Table = require('@editorjs/table');
const Header = require('@editorjs/header');
import Swal from 'sweetalert2'
window.websiteURL="http://127.0.0.1:8000"
var val=[
    {
      type: "image",
      data: {
        url: "https://cdn.pixabay.com/photo/2017/09/01/21/53/blue-2705642_1280.jpg"
      }
    }
  ]
  var myResponse="";

const editor= new EditorJS({
    holder : 'editorjs',
    onReady: () => {
        editor.notifier.show({
          message: 'Editor is ready!'
        });
        $.ajax({
            url : window.websiteURL+'/api/articles/html_editor/'+parseInt($("#article").val()),
            type : 'get',
            dataType : 'json',
            success : function(res, statut){
                editor.blocks.renderFromHTML(res.htmlCode)
            },
        
            error : function(resultat, statut, erreur){
                alert(statut)
                console.log(resultat,erreur)  ;  
            },
        
           
        
         });
      },
      data: {
        time: 1552744582955,
        blocks: val,
        version: "2.11.10"
      },
    tools:{
        raw: RawTool,
        image: SimpleImage,
        checklist: {
            class: Checklist,
            inlineToolbar: true,
          },
        code: CodeTool,
        personality: {
            class: Personality,
            config: {
              endpoint: 'http://localhost:8008/uploadFile'  // Your backend file uploader endpoint
            }
        },
        quote: {
            class: Quote,
            inlineToolbar: true,
            shortcut: 'CMD+SHIFT+O',
            config: {
              quotePlaceholder: 'Enter a quote',
              captionPlaceholder: 'Quote\'s author',
            },
          },
          warning: {
            class: Warning,
            inlineToolbar: true,
            shortcut: 'CMD+SHIFT+W',
            config: {
              titlePlaceholder: 'Title',
              messagePlaceholder: 'Message',
            },
          },
          attaches: {
            class: AttachesTool,
            config: {
              endpoint: 'http://localhost:8008/uploadFile'
            }
          },
          Marker: {
            class: Marker,
            shortcut: 'CMD+SHIFT+M',
          },
          inlineCode: {
            class: InlineCode,
            shortcut: 'CMD+SHIFT+M',
          },
          linkTool: {
            class: LinkTool,
            config: {
              endpoint: 'http://localhost:8008/fetchUrl', // Your backend endpoint for url data fetching
            }
          },
          table: {
            class: Table,
          },
          embed: Embed,
          list: {
            class: List,
            inlineToolbar: true,
          },
          header:Header,
     },
})

function renderHTML(data) {
    let articleHTML = ``;
    for (let block of data.blocks) {
      switch (block.type) {
        case 'paragraph':
            articleHTML += `<div class="ce-block">
              <div class="ce-block__content">
                <div class="ce-paragraph cdx-block">
                  <p>${block.data.text}</p>
                </div>
              </div>
            </div>\n`;
            break;
          case 'image':
            articleHTML += `<div class="ce-block">
              <div class="ce-block__content">
                <div class="ce-paragraph cdx-block">
                  <img src="${block.data.url}" alt="${block.data.caption}" />
                  <div class="text-center">
                    <i>${block.data.caption}</i>
                  </div>
                </div>
              </div>
            </div>\n`;
            break;
          case 'header':
            articleHTML += `<div class="ce-block">
              <div class="ce-block__content">
                <div class="ce-paragraph cdx-block">
                  <h${block.data.level}>${block.data.text}</h${block.data.level}>
                </div>
              </div>
            </div>\n`;
            break;
          case 'raw':
            articleHTML += `<div class="ce-block">
            <div class="ce-block__content">
              <div class="ce-code">
                <code>${block.data.html}</code>
              </div>
            </div>
          </div>\n`;
            break;
          case 'code':
            articleHTML += `<div class="ce-block">
              <div class="ce-block__content">
                <div class="ce-code">
                  <code>${block.data.code}</code>
                </div>
              </div>
            </div>\n`;
            break;
          case 'list':
            if (block.data.style === 'unordered') {
              const list = block.data.items.map(item => {
                return `<li class="cdx-list__item">${item}</li>`;
              });
              articleHTML += `<div class="ce-block">
                <div class="ce-block__content">
                  <div class="ce-paragraph cdx-block">
                    <ul class="cdx-list--unordered">${list.join('')}</ul>
                  </div>
                  </div>
                </div>\n`;
            } else {
              const list = block.data.items.map(item => {
                return `<li class="cdx-list__item">${item}</li>`;
              });
              articleHTML += `<div class="ce-block">
                <div class="ce-block__content">
                  <div class="ce-paragraph cdx-block">
                    <ol class="cdx-list--ordered">${list}</ol>
                  </div>
                  </div>
                </div>\n`;
            }
            break;
          case 'delimeter':
            articleHTML += `<div class="ce-block">
              <div class="ce-block__content">
                <div class="ce-delimiter cdx-block"></div>
              </div>
            </div>\n`;
            break;
           case 'table':
               tr=block.data.content.map(c=>{
                   tds=c.map(td=>{
                       return`<td>${td}</td>`
                   })
                   rep=`<tr>${tds.join('')}</tr>`
                   return rep
               })
            articleHTML+=`<div class="container"><table class="table table-responsive">${tr.join('<br>')} </table></div>`
           case 'embed':
            articleHTML+=`<iframe width="${block.data.width}" height="${block.data.heigth}" src="https://www.youtube.com/embed/TVLURx2nFqw" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe><iframe width="560" height="315" src="${block.data.source}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>` 
           case 'attaches':
            articleHTML+=`<a href="${block.data.file.url}">${block.data.file.name}</a>`
           case 'warning':
            articleHTML+=`<div class="alert alert-warning" title="${block.data.title}">${block.data.message}</div>`
           case 'quote':
            articleHTML+=`<blockquote style="text-align:${block.data.alignment}">${block.data.text}
                          <caption>${block.data.socrate}</caption>
                           </blockquote>`
             break;
             default:
                return '';
        
      }
    }
    return articleHTML;
  }

  var button=document.getElementById('save');
  var button2=document.getElementById('refresh');

  button.addEventListener('click',() => {
    editor.save().then((outputData) => {
        var htmlCode=renderHTML(outputData)
        $.ajax({
            url : window.websiteURL+'/api/articles/html_editor/'+parseInt($("#article").val()),
            type : 'post',
            data:'htmlCode=' + htmlCode+'&jsonCode='+(JSON. stringify(outputData.blocks)),
            dataType : 'html',
            success : function(code_html, statut){
              Swal.fire(
                'Good job!',
                'Your article has been edited successfully!',
                'success'
              )          
         },
     
            error : function(resultat, statut, erreur){
              Swal.fire(
                'Sorry',
                'An error occured!',
                'error'
              )
            },
     
           
     
         });
        
    }).catch((error) => {
      console.log('Saving failed: ', error)
    });
  })
  button2.addEventListener('click',()=>{
    editor.notifier.show({
        message: 'Editor is ready!'
      });
})
  class MyTool {
    constructor({data, api}){
      this.api = api;
      // ...
    }
  
    refreshContent() {
      this.api.blocks.render(
        [
          {
            type: "image",
            data: {
              url: "https://cdn.pixabay.com/photo/2017/09/01/21/53/blue-2705642_1280.jpg"
            }
          },
          {
            type: "header",
            data: {
               text: "New header",
               level: 2
            }
          }
        ]
      );
    }
    // ... other methods
  }

  


