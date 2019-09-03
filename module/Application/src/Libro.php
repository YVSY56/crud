<?php
class Libro implements ILibroDao{
    private $t;

    public function __construct(TableGatewayInterface $t)
    {
        $this->t = $t;
    }


    public function getR($id)
    {
        $id = (int) $id;
        $rowset = $this->t->select(['id' => $id]);
        $row = $rowset->current();
        if (! $row) {
            throw new RuntimeException(sprintf(
                'no existe  %d',
                $id
            ));
        }

        return $row;
    }

    public function guardarL(Libro $libro)
    {
        $id = (int) $libro->id;


        try {
            $this->getR($id);
        } catch (RuntimeException $e) {
            throw new RuntimeException(sprintf(
                'Identificador %d; no existe',
                $id
            ));
        }

        $this->t->update($data, ['id' => $id]);
    }

    public function deleteL($id)
    {
        $this->t->delete(['id' => (int) $id]);
    }
}

?>