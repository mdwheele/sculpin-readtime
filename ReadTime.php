<?php

namespace Mdwheele\Sculpin\Bundle\ReadTimeBundle;

use Sculpin\Core\Event\SourceSetEvent;
use Sculpin\Core\Sculpin;
use Sculpin\Core\Source\FileSource;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ReadTime implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        return [
            Sculpin::EVENT_BEFORE_RUN => 'beforeRun',
        ];
    }

    public function beforeRun(SourceSetEvent $sourceSetEvent)
    {
        $sourceSet = $sourceSetEvent->sourceSet();

        foreach ($sourceSet->updatedSources() as $source) {
            /** @var FileSource $source */

            if ($source->isGenerated()) {
                continue;
            }

            if ($this->isPost($source)) {
                $this->setReadTime($source);
            }
        }
    }

    private function isPost(FileSource $source)
    {
        if ($source->canBeFormatted()) {
            $pathSegments = explode('/', $source->relativePathname());
            if (!empty($pathSegments)) {
                return array_shift($pathSegments) == '_posts';
            }
        }

        return false;
    }

    private function setReadTime(FileSource $source)
    {
        $wordCount = count(preg_split('/\s+/', $source->content()));
        $wordsPerMinute = 200;

        $readTimeInMinutes = ceil($wordCount / $wordsPerMinute);

        $source->data()->set('read_time', $readTimeInMinutes);
    }
}