<?php

namespace App\Admin\Extensions;

use Encore\Admin\Admin;

class TrashAction
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    protected $trans = [];
    
    protected function script()
    {
        $trans = [
            'confirm'        => trans('admin.confirm'),
            'cancel'         => trans('admin.cancel'),
        ];

        $trans = array_merge($trans, $this->trans);

        return <<<SCRIPT

            $('.grid-trash-row').on('click', function () {

                // Your code.
                console.log($(this).data('id'));
                
                var id = $(this).data('id');

                swal({
                    title: "Apakah anda yakin?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "{$trans['confirm']}",
                    showLoaderOnConfirm: true,
                    cancelButtonText: "{$trans['cancel']}",
                    preConfirm: function() {
                        return new Promise(function(resolve) {
                            $.ajax({
                                method: 'post',
                                url: 'posts/trash/' + id,
                                data: {
                                    _method:'put',
                                    _token:LA.token,
                                },
                                success: function (data) {
                                        $.pjax.reload('#pjax-container', async = false);
                                    resolve(data);
                                }
                            });
                        });
                    }
                }).then(function(result) {
                    var data = result.value;
                    if (typeof data === 'object') {
                        if (data.status) {
                           
                            swal(data.message, '', 'success');
                        } else {
                            swal(data.message, '', 'error');
                        }
                    } 
                });
            });

SCRIPT;
    }

    protected function render()
    {
        Admin::script($this->script());

        return "<a href='javascript:void(0);' data-id='{$this->id}' class='grid-trash-row'><i class='fa fa-trash'></i></a>";
    }

    public function __toString()
    {
        return $this->render();
    }

    public function setTrans($tans)
    {
        $this->trans = $tans;
    }
}