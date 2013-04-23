<?php

namespace TCE\SAN\controllers;

/**
 * @RemoteClass
 */
class Sexo extends \Champion\Controller {

    /**
     * @RemoteMethod
     */
    public function getSexos()
    {
        try {
            $qb = $this->getEM()->createQueryBuilder();
            $qb->select('s.id, s.descricao')
                    ->from('\TCE\SAN\models\Sexo', 's');
            $retorno = $qb->getQuery()->getArrayResult();
            $this->array_walk_recursive_referential($retorno, 'utf8_encode');
            return [
                'raiz' => $retorno,
                'sql' => $this->getSqlProfiler()
            ];
        } catch (\Exception $e) {
            return [
                'success' => FALSE,
                'msg' => 'Ocorreu um erro.',
                'title' => 'Falha'
            ];
        }
    }

    /** @RemoteMethod */
    public function getSexo()
    {
        try {
            if (!isset($_POST['id'])) {
                return [
                    'success' => FALSE,
                    'msg' => 'Código não enviado.',
                    'title' => 'Falha'
                ];
            }
            $qb = $this->getEM()->createQueryBuilder();
            $qb->select('p.id, p.descricao')
                    ->from('\TCE\SAN\models\Sexo', 'p')
                    ->where('p.id = :id')
                    ->setParameter('id', trim($_POST['id']));
            $retorno = $qb->getQuery()->getArrayResult();
            $this->array_walk_recursive_referential($retorno[0], 'utf8_encode');
            return [
                'success' => TRUE,
                'dados' => $retorno[0]
            ];
        } catch (\Exception $e) {
            return [
                'success' => FALSE,
                'msg' => 'Ocorreu um erro.',
                'title' => 'Falha',
                'erro' => $e->getMessage(),
                'sql' => $this->SqlProfiler()
            ];
        }
    }

    /** @RemoteMethod */
    public function salvarSexo()
    {
        try {
            $sexo = NULL;
            if (isset($_POST['id']) && !empty($_POST['id'])) {
                $sexo = $this->getEM()
                        ->getRepository('\TCE\SAN\models\Sexo')
                        ->findOneBy(['id' => trim($_POST['id'])]);
            } else {
                $sexo = new \TCE\SAN\models\Sexo();
            }
            $sexo->setDescricao(trim($_POST['descricao']));
            $this->getEM()->persist($sexo);
            $this->getEM()->flush();
            return [
                'success' => TRUE,
                'msg' => 'Salvo com sucesso.',
                'title' => 'Sucesso'
            ];
        } catch (\Exception $e) {
            return [
                'success' => FALSE,
                'msg' => 'Não foi possível salvar.',
                'title' => 'Falha',
                'erro' => $e->getMessage(),
                'sql' => $this->SqlProfiler()
            ];
        }
    }

    /** @RemoteMethod */
    public function excluirSexo()
    {
        try {
            if (!isset($_POST['id'])) {
                return [
                    'success' => FALSE,
                    'msg' => 'Código não enviado.',
                    'title' => 'Falha'
                ];
            }
            $sexo = $this->getEM()
                    ->getRepository('\TCE\SAN\models\Sexo')
                    ->findOneBy(['id' => trim($_POST['id'])]);
            if (empty($sexo)) {
                return [
                    'success' => FALSE,
                    'msg' => 'Registro não encontrado.',
                    'title' => 'Falha'
                ];
            }
            $this->getEM()->remove($sexo);
            $this->getEM()->flush();
            return [
                'success' => TRUE,
                'msg' => 'Excluído com sucesso.',
                'title' => 'Sucesso'
            ];
        } catch (\Exception $e) {
            return [
                'success' => FALSE,
                'msg' => 'Não foi possível salvar.',
                'title' => 'Falha',
                'erro' => $e->getMessage(),
                'sql' => $this->SqlProfiler()
            ];
        }
    }

}