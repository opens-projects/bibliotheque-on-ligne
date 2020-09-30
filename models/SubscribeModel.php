<?php 
	/**
	 * SouscribeModel
	 */
	class SubscribeModel extends Model
	{
		public function subscribe($data, $already = false)
		{
			$this->table = 'souscrire';
			
			if ($already) {
				return $this->update($data);
			}
			
			return $this->add($data);
		}
	}


 ?>