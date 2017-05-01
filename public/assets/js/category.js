/**
 * Created by ray on 2017/4/24.
 */

var Category = (function () {

    function Category() {
        this.category = this;
        this.parentId = 0;
        this.currentId = 1;
        this.url = "";
    }

    var core = new Core();
    var tempHtml = [];
    var template = {
        back : ['<div class="btn-group" style="width: 100%; min-width: 300px">',
            '<button type="button" class="btn btn-ms btn-default back-to-parent" data-id="${id}" ><i class="fa fa-angle-double-left"></i> </button>',
            '<button type="button" class="btn btn-default select-category" style="width: 220px" data-id="${id}" >${text}</button>',
            '</div>'
        ].join(''),
        next : ['<div class="btn-group " style="width: 100%; min-width: 300px" >',
            '<button type="button" class="btn btn-ms btn-default select-category " style="width: 220px" data-id="${id}">${text}</button>',
            '<button type="button" class="btn btn-ms btn-default go-to-children " data-id="${id}"  ${disabled} >',
            '   <i class="fa fa-angle-double-right"></i>',
            ' </button>',
            '</div>'
        ].join('')
    };

    Category.prototype.render = function (targetElement) {
        var category = this;
        console.log(this.currentId);
        var temp = this.url + "/" + this.currentId;
        $.get(temp, function (json) {
            console.log(json);
            $(targetElement).html(category.draw(json));
        }, "json");
    };

    Category.prototype.draw = function (json) {
        tempHtml = [];
        var disabled = '';
        var self = json.self;
        if (this.currentId >= 1) {
            tempHtml.push(core.html(template.back, {id: self.parent_id, text: self.name}));
        }
        var list = json.list;
        for (var i = 0; i < list.length; i++) {
            var item = list[i];
            disabled = '';
            if (item.children <= 0) {
                disabled = 'disabled';
            }
            tempHtml.push(core.html(template.next, {id: item.id, text: item.name, disabled: disabled}));
        }
        return tempHtml.join('');
    };

    return Category;
})();
