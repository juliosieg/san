Ext.define('SAN.window.ui.GrupoAlimento', {
    extend: 'Champion.window.Base',
    modal:true,
    height: 210,
    width: 532,
    layout: {
        type: 'fit'
    },
    title: 'Grupo de Alimento',

    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
            items: [
            {
                xtype: 'form',
                border: false,
                bodyPadding: 10,
                title: '',
                items: [
                {
                    xtype: 'fieldcontainer',
                    layout: {
                        align: 'stretch',
                        type: 'hbox'
                    },
                    fieldLabel: '',
                    items: [
                    {
                        xtype: 'textfield',
                        flex: 1,
                        fieldLabel: 'Código',
                        disabled:true,
                        allowBlank:false,
                        labelWidth: 45
                    },
                    {
                        xtype:'hiddenfield',
                        name:'id'
                    },
                    {
                        xtype: 'textfield',
                        flex: 3,
                        allowBlank:false,
                        margin: '0 0 0 10',
                        name:'descricao',
                        fieldLabel: 'Descrição',
                        labelWidth: 60
                    }
                    ]
                },
                {
                    xtype: 'textareafield',
                    anchor: '100%',
                    height: 89,
                    allowBlank:false,
                    name:'observacao',
                    margin: '10 0 0 0',
                    fieldLabel: 'Observação',
                    labelWidth: 75
                }
                ]
            }
            ],
            buttons:[
            {
                iconCls:'silk-disk',
                text:'Salvar',
                scope:this,
                handler:function(){
                    var form = this.down('form').getForm();
                    if(form.isValid()){
                        form.submit({
                            scope:this,
                            url:TCE.SAN.getUrlController('GrupoAlimento','salvarGrupoAlimento'),
                            success:function(form,action){
                                var resposta = action.result;
                                Ext.Msg.show({
                                    modal: true,
                                    title: resposta.title,
                                    msg: resposta.msg,
                                    buttons: Ext.Msg.OK,
                                    icon: Ext.Msg.INFO
                                });
                                Ext.data.StoreManager.lookup('SAN.store.GrupoAlimento').load();
                                this.close();
                            },
                            failure:function(form,action){
                                var resposta = action.result;
                                Ext.Msg.show({
                                    modal: true,
                                    title: resposta.title,
                                    msg: resposta.msg,
                                    buttons: Ext.Msg.OK,
                                    icon: Ext.Msg.ERROR
                                });
                            }
                        });
                    }
                }
            },
            {
                iconCls:'silk-cross',
                text:'Fechar',
                scope:this,
                handler:function(){
                    this.close();
                }
            }
            ]
        });

        me.callParent(arguments);
    }

});