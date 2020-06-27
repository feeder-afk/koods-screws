<?php
namespace koods;
/**
 * Clase que crea componentes html,
 * al imprimir o ejecutar el objeto creado devuelve un string con una estructura html
 * 
 * @author Feeder
 * @author cmborgono@gmail.com
 */
class Screws{	
	private $kind;	
	private $props;
	private $content;
	
	public function __construct( array $data ){
		if( !empty( $data['kind'] ) ){
			$this->kind = trim( $data['kind'] );
			$cont = '';
			if( !empty( $data['content'] ) ){
				if( is_array( $data['content'] ) ){
					$cont = new Screws( $data['content'] );
				}else{
					$cont = $data['content'];
				}
			}
			if( $this->hasClose() )
				$this->content = $cont;
			$this->props = ( !empty( $data['props'] ) )?$data['props']:'';
		}else{			
			if( !is_array( $data ) ){
				$this->content = $data;
			}else if( !empty( $data ) ){
				foreach( $data as $d ){
					if( is_a( $d, __CLASS__ ) )
						$this->content .= $d;
					else
						$this->content .= new Screws( $d );					
				}
			}
		}
	}
	
	public function __toString(){
		if( empty( $this->kind ) ) return $this->content;
		$output = '<'.$this->kind;
		if( !empty( $this->props ) ){
			foreach( $this->props as $key => $item ){
				$output .= ' '.$key.'="'.$item.'"';
			}
		}		
		if( $this->hasClose() ){
			$output .= '>';
			$output .= strval( $this->content );
			$output .= '</'.$this->kind.'>';
		}else{
			$output .= '/>';
		}		
		return $output;		
	}
	
	public function __invoke(){
		return $this->__toString();
	}
	
	private function hasClose(  ){
		switch( $this->kind ){
			case 'base':
			case 'link':
			case 'meta':
			case 'hr':
			case 'br':
			case 'img':
			case 'embed':
			case 'param':
			case 'video':
			case 'audio':
			case 'source':
			case 'area':
			case 'track':
			case 'input':
				return false;
				break;
			default:
				return true;
		}
	}
}