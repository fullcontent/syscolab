<?php namespace App\Http\Controllers;

use Session;
use Request;
use DB;
use CRUDBooster;

use App\Models\Produtos;
use App\Models\Envio;
use App\Models\EnvioItem;
use App\User;
use App\Models\Colaber;

use DNS1D;
use App;

	class AdminEnviosController extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "id";
			$this->limit = "20";
			$this->orderby = "created_at,desc";
			$this->global_privilege = false;
			$this->button_table_action = true;
			$this->button_bulk_action = true;
			$this->button_action_style = "button_icon";
			$this->button_add = true;
			$this->button_edit = true;
			$this->button_delete = true;
			$this->button_detail = true;
			$this->button_show = false;
			$this->button_filter = false;
			$this->button_import = false;
			$this->button_export = false;
			$this->table = "envios";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Num Envio","name"=>"id","width"=>"10%"];
			$this->col[] = ["label"=>"Data","name"=>"created_at",'callback_php'=>'date("d/m/Y",strtotime($row->created_at))'];




if(CRUDBooster::myPrivilegeName() != "Colabers"){

				$this->col[] = ["label"=>"Colaber","name"=>"user_id","join"=>"cms_users,name"];
			}


			$this->col[] = ["label"=>"TipoEnvio","name"=>"tipoEnvio"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];


			$userID=CRUDBooster::myId();



			$this->form[] = ['label'=>'UserID','name'=>'user_id','type'=>'hidden','width'=>'col-sm-10','value'=>$userID];
			$this->form[] = ['label'=>'Destino','name'=>'tipoEnvio','type'=>'select','width'=>'col-sm-10','dataenum'=>'Loja;Feira'];
			


			if(CRUDBooster::myPrivilegeName() == 'Colabers')
				{

					$columns[] = ['label'=>'Produto','name'=>'produto_id','type'=>'datamodal','datamodal_table'=>'produtos','datamodal_columns'=>'nome,codigo,cor,valor','datamodal_select_to'=>'id:produto_id','datamodal_where'=>'user_id='.$userID.'','required'=>true,'width'=>'col-sm-3'];
				}else{

					$columns[] = ['label'=>'Produto','name'=>'produto_id','type'=>'datamodal','datamodal_table'=>'produtos','datamodal_columns'=>'nome,codigo,cor,valor','datamodal_select_to'=>'id:produto_id','required'=>true,'width'=>'col-sm-3'];
				}

			


			$columns[] = ['label'=>'Quantidade','name'=>'qtde','type'=>'number','required'=>true,'value'=>'1'];			


			$this->form[] = ['label'=>'Detalhes','name'=>'envio_detalhes','type'=>'child','columns'=>$columns,'table'=>'envio_items','foreign_key'=>'envio_id'];



$this->form[] = ['label'=>'Observações','name'=>'comments','type'=>'textarea','width'=>'col-sm-10'];


			




			# END FORM DO NOT REMOVE THIS LINE

			

			/* 
	        | ---------------------------------------------------------------------- 
	        | Sub Module
	        | ----------------------------------------------------------------------     
			| @label          = Label of action 
			| @path           = Path of sub module
			| @foreign_key 	  = foreign key of sub table/module
			| @button_color   = Bootstrap Class (primary,success,warning,danger)
			| @button_icon    = Font Awesome Class  
			| @parent_columns = Sparate with comma, e.g : name,created_at
	        | 
	        */
	        $this->sub_module = array();


	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add More Action Button / Menu
	        | ----------------------------------------------------------------------     
	        | @label       = Label of action 
	        | @url         = Target URL, you can use field alias. e.g : [id], [name], [title], etc
	        | @icon        = Font awesome class icon. e.g : fa fa-bars
	        | @color 	   = Default is primary. (primary, warning, succecss, info)     
	        | @showIf 	   = If condition when action show. Use field alias. e.g : [id] == 1
	        | 
	        */
	        $this->addaction = array();

	        

	        $this->addaction[] = ['label'=>'Gerar Etiquetas','icon'=>'fa fa-barcode','color'=>'warning','url'=>CRUDBooster::mainpath('etiquetas').'/[id]'];

	        $this->addaction[] = ['label'=>'Gerar Relatorio','icon'=>'fa fa-barcode','color'=>'primary','url'=>CRUDBooster::mainpath('relatorio').'/[id]'];



	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add More Button Selected
	        | ----------------------------------------------------------------------     
	        | @label       = Label of action 
	        | @icon 	   = Icon from fontawesome
	        | @name 	   = Name of button 
	        | Then about the action, you should code at actionButtonSelected method 
	        | 
	        */
	        $this->button_selected = array();

	                
	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add alert message to this module at overheader
	        | ----------------------------------------------------------------------     
	        | @message = Text of message 
	        | @type    = warning,success,danger,info        
	        | 
	        */
	        $this->alert        = array();
	                

	        
	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add more button to header button 
	        | ----------------------------------------------------------------------     
	        | @label = Name of button 
	        | @url   = URL Target
	        | @icon  = Icon from Awesome.
	        | 
	        */
	        $this->index_button = array();



	        /* 
	        | ---------------------------------------------------------------------- 
	        | Customize Table Row Color
	        | ----------------------------------------------------------------------     
	        | @condition = If condition. You may use field alias. E.g : [id] == 1
	        | @color = Default is none. You can use bootstrap success,info,warning,danger,primary.        
	        | 
	        */
	        $this->table_row_color = array();     	          

	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | You may use this bellow array to add statistic at dashboard 
	        | ---------------------------------------------------------------------- 
	        | @label, @count, @icon, @color 
	        |
	        */
	        $this->index_statistic = array();



	        /*
	        | ---------------------------------------------------------------------- 
	        | Add javascript at body 
	        | ---------------------------------------------------------------------- 
	        | javascript code in the variable 
	        | $this->script_js = "function() { ... }";
	        |
	        */

	        

	        
	        $this->script_js = "


	        		$(document).ready(function() {
  					$(window).keydown(function(event){
   						 if(event.keyCode == 13) {
      					event.preventDefault();
     					 return false;
					    }
					  });
					});
						
					$('.button_action a.btn-warning').click(function() {
    				$(this).attr('target', '_blank');
					});

					$('.button_action a.btn-primary').click(function() {

    				
					window.open('".$relatorio."','page','toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=600,height=600');


					});
					
					$('.input-group-btn button').each(function() {
    					var text = $(this).text();
    					$(this).html(text.replace(' Browse Data', ' Buscar Produtos')); 
						});
					
					$('#btn-add-table-detalhes').val('Adicionar a remessa');
					$('#btn-reset-form-detalhes').val('Apagar');

					$('.panel-heading').each(function() {
    					var text = $(this).text();
    					$(this).html(text.replace('Table Detail', 'Detalhes da Remessa')); 
						});
					$('.modal-title').each(function() {
    					var text = $(this).text();
    					$(this).html(text.replace(' Browse Data Produto', 'Buscar dados de Produtos')); 
						});
					

					$('#detalhesqtde').val(1);

					$('#tipoEnvio').val('Loja');
										

					$('#btn-add-table-detalhes').click(function() {
  					
						$('#detalhesqtde').val(1);

					});


					

	        ";


            /*
	        | ---------------------------------------------------------------------- 
	        | Include HTML Code before index table 
	        | ---------------------------------------------------------------------- 
	        | html code to display it before index table
	        | $this->pre_index_html = "<p>test</p>";
	        |
	        */
	        $this->pre_index_html = null;
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include HTML Code after index table 
	        | ---------------------------------------------------------------------- 
	        | html code to display it after index table
	        | $this->post_index_html = "<p>test</p>";
	        |
	        */
	        $this->post_index_html = null;
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include Javascript File 
	        | ---------------------------------------------------------------------- 
	        | URL of your javascript each array 
	        | $this->load_js[] = asset("myfile.js");
	        |
	        */
	        $this->load_js = array();
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Add css style at body 
	        | ---------------------------------------------------------------------- 
	        | css code in the variable 
	        | $this->style_css = ".style{....}";
	        |
	        */
	        $this->style_css = NULL;
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include css File 
	        | ---------------------------------------------------------------------- 
	        | URL of your css each array 
	        | $this->load_css[] = asset("myfile.css");
	        |
	        */
	        $this->load_css = array();
	        
	        
	    }


	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for button selected
	    | ---------------------------------------------------------------------- 
	    | @id_selected = the id selected
	    | @button_name = the name of button
	    |
	    */


	    public function getEtiquetas($id) {
  			 		

            $envios = Envio::whereHas('itens')->withCount('itens')->with('user')->find($id);

            $envio_id = $envios->id;
           

            $itens = EnvioItem::with('produto')->where('envio_id', $envio_id)->get();


            $html = "<div class='page-center'>";
        

            foreach ($itens as $key => $item) {
                for ($i=0; $i < $item->qtde; $i++) { 
                $codigo = $item->produto->codigo;
                $code = DNS1D::getBarcodeSVG($codigo, "EAN8",1,35);
                $user = Colaber::where('user_id',$item->produto->user_id)->first();
                    
        		$html .= "<div class='col'>";

        $html .= "<div class='etiqueta'><p class='marca'>".mb_strtoupper($user->marca)."</p><p class='produto'>".mb_strtoupper($item->produto->nome)."</p><p class='atributos'><span>".mb_strtoupper($item->produto->cor)."</span> | <span>".mb_strtoupper($item->produto->tamanho)."</span></p>".$code."<p>".$codigo."</p><h5>  R$ ".$item->produto->valor."</h5></div>";

                 $html .= "</div>";

				        }

        	

                  
            }
            


            $pdf = App::make('dompdf.wrapper');
            $pdf->loadHTML($html);








            //return $pdf->stream('etiquetas.pdf');
                        
            return view('etiquetas')->with(['html'=>$html,'user'=>$user,'envios'=>$envios,'itens'=>$itens]);
		

		}

		public function getRelatorio($id)
		{	

			$envios = Envio::whereHas('itens')->withCount('itens')->with('user')->find($id);

            $envio_id = $envios->id;
				
			$itens = EnvioItem::with('produto')->where('envio_id', $envio_id)->get();

			foreach($itens as $item)
			{


				$user = Colaber::where('user_id',$item->produto->user_id)->first();
			}


			return view('relatorio')->with(['itens'=>$itens,'user'=>$user]);


		}



	    public function actionButtonSelected($id_selected,$button_name) {
	        //Your code here
	            
	    }


	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate query of index result 
	    | ---------------------------------------------------------------------- 
	    | @query = current sql query 
	    |
	    */
	    public function hook_query_index(&$query) {
	        //Your code here

	         $userID=CRUDBooster::myId();



	        if(CRUDBooster::myPrivilegeName() == 'Colabers'){

	        	$query->where('user_id',$userID);

	        }
	            
	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate row of index table html 
	    | ---------------------------------------------------------------------- 
	    |
	    */    
	    public function hook_row_index($column_index,&$column_value) {	        
	    	//Your code here
	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate data input before add data is execute
	    | ---------------------------------------------------------------------- 
	    | @arr
	    |
	    */
	    public function hook_before_add(&$postdata) {        
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after add public static function called 
	    | ---------------------------------------------------------------------- 
	    | @id = last insert id
	    | 
	    */
	    public function hook_after_add($id) {        
	        
	        
	         $gerencia = User::where('id_cms_privileges',3)->get();

	         $usuario = User::find(CRUDBooster::myId());

            foreach($gerencia as $g){

              	$user[]=$g->id;
            }

            CRUDBooster::sendNotification($config=[
                'content'=>''.$usuario->name.' adicionou uma remessa',
                 'to'=>CRUDBooster::adminPath('notifications'),
                 'id_cms_users'=>$user]);

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate data input before update data is execute
	    | ---------------------------------------------------------------------- 
	    | @postdata = input post data 
	    | @id       = current id 
	    | 
	    */
	    public function hook_before_edit(&$postdata,$id) {        
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after edit public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_after_edit($id) {
	        //Your code here 

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command before delete public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_before_delete($id) {
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after delete public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_after_delete($id) {
	        //Your code here

	    }



	    //By the way, you can still create your own method in here... :) 


	}