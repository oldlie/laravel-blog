/**
 * Created by chenlie on 2017/4/29.
 */

var Post = (function () {

    var core = new Core();

    var template = {
      tr : [
          '<tr>',
          '    <!--td><input type="checkbox"></td-->',
          '    <td>',
          '        <div class="btn-group"  style="width: 80px;">',
          '            <a class="btn btn-default btn-xs" ${href} target="_blank"><i class="fa fa-edit"></i></a>',
          '             <form action="${del_url}" method="post">',
          '             <input type="hidden" name="_token" value="${_token}">',
          '             <input type="hidden" name="_method" value="delete">',
          '            <button class="btn btn-danger btn-xs delete-post-btn" data-id="${id}"><i class="fa fa-trash"></i></button>',
          '             </form>',
          '        </div>',
          '    </td>',
          '    <td class="mailbox-subject"><a ${edit_href} target="_blank">${title}</a></td>',
          '</tr>'
      ].join(''),
        empty: ['<tr><td>这个栏目下还没有发布过文章。</td></tr>'].join('')

    };

    function Post() {
        this.url = "";
    }

    Post.prototype.list = function (url, category, page, callback) {
        var getUrl = url + '/' + category + "?page=" + page;
        $.get(getUrl, function (json) {
            console.log(json);
            callback(json);
        }, 'json');
    };

    Post.prototype.drawHtml = function (json) {
        var html = [];
        if (json.total > 0) {
            for (var i = 0; i < json.data.length; i++) {
                var post = json.data[i];
                html.push(core.html(template.tr, {
                    id: post.id,
                    href: 'href="' + this.url + '/admin/post/' + post.id + '/edit"',
                    del_url: this.url + '/admin/post/' + post.id,
                    _token: _token,
                    edit_href: 'href="' + this.url + '/blog/detail/' + post.slug + '"',
                    title: post.title
                }));
            }
        } else {
            html.push(template.empty);
        }
        return html.join('');
    };

    Post.prototype.render = function (element, json) {
        $(element).html(this.drawHtml(json));
    };



    
    return Post;
})();