/**
 * Created by ray on 2017/4/24.
 */

var Category = (function () {

    function Category() {
        this.parentId = 0;
        this.currentId = 1;
        this.url = "";
    }

    var core = new Core();
    var tempHtml = [];
    var template = {
        back : ['<div class="btn-group" style="width: 100%; min-width: 300px">',
            '<button type="button" class="btn btn-ms btn-default" data-id="{id}" onclick="category.go2Child()"><i class="fa fa-angle-double-left"></i> </button>',
            '<button type="button" class="btn btn-default" style="width: 220px" data-id="${id}" onclick="category.select()">${text}</button>',
            '</div>'
        ].join(''),
        next : ['<div class="btn-group " style="width: 100%; min-width: 300px" >',
            '<button type="button" class="btn btn-ms btn-default " style="width: 220px" data-id="${id}" onclick="category.select()">${text}</button>',
            '<button type="button" class="btn btn-ms btn-default " data-id="${id}"  ${disabled} onclick="category.go2Child()">',
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

    Category.prototype.select = function () {
        $('#inputParentID').val($(event.target).attr('data-id'));
        $('#inputParentCategory').val($(event.target).text());
        $('#selectParentIDModal').modal('hide');
    };

    Category.prototype.go2Child = function() {
        this.currentId = $(event.target).attr('data-id');
        this.render('#categoriesList');
        event.preventDefault();
    };

    Category.prototype.go2Parent = function() {
        this.currentId = $(event.target).attr('data-id');
        this.render('#categoriesList');
        event.preventDefault();
    };

    return Category;
})();
