<?php

namespace App\Controller;

use App\Entity\Supplier;
use App\Form\SupplierType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SupplierController extends AbstractController
{
    /**
     * @Route("/supplier", name="supplier_list")
     */
    public function listAction()
    {
        $supplier = $this->getDoctrine()
            ->getRepository(Supplier::class)
            ->findAll();
        return $this->render('supplier/index.html.twig', [
            'suppliers' => $supplier
        ]);
    }
    /**
     * @Route("/supplier/details/{id}", name="supplier_details")
     */
    public
    function detailsAction($id)
    {
        $supplier = $this->getDoctrine()
            ->getRepository(Supplier::class)
            ->find($id);

        return $this->render('supplier/details.html.twig', [
            'suppliers' => $supplier
        ]);
    }
    /**
     * @Route("/supplier/delete/{id}", name="supplier_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $supplier = $em->getRepository(Supplier::class)->find($id);
        $em->remove($supplier);
        $em->flush();

        $this->addFlash(
            'error',
            'Deleted successful'
        );

        return $this->redirectToRoute('supplier_list');
    }
    /**
     * @Route("/supplier/create", name="supplier_create", methods={"GET","POST"})
     */
    public function createAction(Request $request)
    {
        $supplier = new Supplier();
        $form = $this->createForm(SupplierType::class, $supplier);

        if ($this->saveChanges($form, $request, $supplier)) {
            $this->addFlash(
                'notice',
                'Added Successful'
            );

            return $this->redirectToRoute('supplier_list');
        }

        return $this->render('supplier/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function saveChanges($form, $request, $supplier)
    {
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
//            $supplier->setSupplierID($request->request->get('supplier')['supplierID']);
            $supplier->setSuppliername($request->request->get('supplier')['Suppliername']);
//            $supplier->setPhonenumber($request->request->get('supplier')['Phonenumber']);
//            $supplier->setAddress($request->request->get('supplier')['Address']);
//            $car->setPriority($request->request->get('car')['priority']);
//            $car->setDueDate(\DateTime::createFromFormat('Y-m-d', $request->request->get('todo')['due_date']));
            $em = $this->getDoctrine()->getManager();
            $em->persist($supplier);
            $em->flush();

            return true;
        }
        return false;
    }
    /**
     * @Route("/supplier/edit/{id}", name="supplier_edit")
     */
    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $supplier = $em->getRepository(Supplier::class)->find($id);

        $form = $this->createForm(SupplierType::class, $supplier);

        if ($this->saveChanges($form, $request, $supplier)) {
            $this->addFlash(
                'notice',
                'Edited Successful'
            );
            return $this->redirectToRoute('supplier_list');
        }

        return $this->render('supplier/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
