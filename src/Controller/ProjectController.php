<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Service\ProjectManager;
use App\Form\ProjectType;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ProjectController extends AbstractController {

    private $projectManager;

    public function __construct(ProjectManager $projectManager)
    {
        $this->projectManager = $projectManager;
    }

    /**
     * @Route("/projects", methods={"POST"})
     */
    public function postProject(Request $request, NormalizerInterface $normalizer): JsonResponse
    {
        $project = $this->projectManager->createProject();
        $form = $this->createForm(ProjectType::class, $project);
        $form->submit(json_decode($request->getContent(), true));
        
        if ($form->isSubmitted() && $form->isValid()) {
            $normalized = $normalizer->normalize($form->getData(), 'json');
            return $this->json($normalized, JsonResponse::HTTP_CREATED);
        }

        return $this->json("An error occured. Syntax or content is invalid", JsonResponse::HTTP_BAD_REQUEST);
    }
}
